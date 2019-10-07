<?php

namespace App\Http\Controllers;

use App\Answer;
use App\BaseMataKuliah;
use App\DosenPembimbing;
use App\Mahasiswa;
use App\MataKuliah;
use App\Question;
use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;

class FormController extends Controller
{
    public function index()
    {
        $sections = \App\Section::with('questions')->get();
        $mata_kuliahs = BaseMataKuliah::all();
        return view('form', compact('sections', 'mata_kuliahs'));
    }

    private $x = [];

    public function storeForm1(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        $temp = $this->removeUsedParamsForm1($request);
        try {
            DB::beginTransaction();
            foreach ($temp->request as $index => $var) {
                $t = explode('_', $index);
                if($t[count($t)-1] == "etc"){
                    // TODO : etc
                    continue;
                }
                Answer::create([
                    'id_question' => Question::where('slug', $index)->first()->id,
                    'id_mahasiswa' => $mahasiswa->id,
                    'answer' => $var
                ]);

            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        $mahasiswa->update(['form1' => 1]);
        toastr()->success('Form berhasil diisi');
        return redirect('/dashboard');
//        return $this->getForm($mahasiswa->id);
    }

    public function storeForm2(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        $temp = $this->removeUsedParamsForm2($request);
        try {
            DB::beginTransaction();
            $temp__ = "";
            foreach ($temp->request as $index => $var) {
                $t = explode('_', $index);
                if($index == "bahasa_penelitian"){
                    $temp__ = implode(", ", $var);
                    if(!is_null($temp->bahasa_penelitian_etc)){
                        $temp__ .= ", " . $temp->bahasa_penelitian_etc;
                    }
                    Answer::create([
                        'id_question' => Question::where('slug', $index)->first()->id,
                        'id_mahasiswa' => $mahasiswa->id,
                        'answer' => $temp__
                    ]);
                    continue;
                }
                if($t[count($t)-1] == "etc"){
                    // TODO : etc
                    continue;
                }
                Answer::create([
                    'id_question' => Question::where('slug', $index)->first()->id,
                    'id_mahasiswa' => $mahasiswa->id,
                    'answer' => $var
                ]);

            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
        $mahasiswa->update(['form2' => 1]);
        toastr()->success('Form berhasil diisi');
        return redirect('/dashboard');
//        return $this->getForm($mahasiswa->id);
    }

    public function getForm($id)
    {
        $data = Mahasiswa::with('answers.question', 'dosenPembimbings', 'mataKuliahs')->findOrFail($id);
        try {
            $templateProcessor = new TemplateProcessor('Template Laporan.docx');
            $templateProcessor->setValue('nama', $data->nama);
            $templateProcessor->setValue('nim', $data->nim);
            $templateProcessor->setValue('dosen_pembimbing_utama', $data->dosen_pembimbing_utama);
            $templateProcessor->setValue('dosen_pembimbing_akademik', $data->dosen_pembimbing_akademik);
            $templateProcessor->setValue('tahun_masuk', $data->tahun_masuk);
            $templateProcessor->setValue('jenjang_studi', $data->jenjang_studi);

            $templateProcessor->setValue('dpa_1', $data->dosenPembimbings[0]->nama);
            $templateProcessor->setValue('dpa_2', $data->dosenPembimbings[1]->nama);
            $templateProcessor->setValue('dpa_3', $data->dosenPembimbings[2]->nama);

            foreach ($data->answers as $answer) {
                if ($answer->question->type == "radio") {
                    $val = is_null($answer->answer) ? ' - ' : $answer->answer == '1' ? 'Ya' : 'Tidak';
                    $templateProcessor->setValue($answer->question->slug, $val);
                } elseif ($answer->question->type == "checkbox") {
                    $mk = MataKuliah::with('baseMataKuliah')->where('id_mahasiswa', $data->id)->get();
                    foreach ($mk as $i => $matkul) {
                        $val = !is_null($matkul->baseMataKuliah->mata_kuliah) ? $matkul->baseMataKuliah->mata_kuliah . ' / ' . $matkul->baseMataKuliah->sks . ' SKS' : '';
                        $templateProcessor->setValue('mata_kuliah_belum_' . ($i + 1), $val);
                    }
                } else {
                    $templateProcessor->setValue($answer->question->slug, is_null($answer->answer) ? '' : $answer->answer);
                }
            }

            $export_file = public_path("Formulir Pengajuan Pascasarjana $data->nim.docx");

            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        } catch (CopyFileException $e) {
        } catch (CreateTemporaryFileException $e) {
        }
    }

    private function removeUsedParamsForm1(Request $request)
    {
        $request->request->remove('_token');
        $questions = Question::select(['id', 'slug'])->where('section', '<', 13)->get();
        foreach ($questions as $question) {
            if (!$request->has($question->slug)) {
                $request->request->set($question->slug, null);
            }
        }
        return $request;
    }

    private function removeUsedParamsForm2(Request $request)
    {
        $request->request->remove('_token');
        $questions = Question::select(['id', 'slug'])->where('section', '<', 13)->get();
        foreach ($questions as $question) {
            if (!$request->has($question->slug)) {
                $request->request->set($question->slug, null);
            }
        }
        return $request;
    }

    public function testing()
    {
        $id = 13;
        $data = Mahasiswa::with('answers.question', 'dosenPembimbings', 'mataKuliahs')->findOrFail($id);
        try {
            $templateProcessor = new TemplateProcessor('Template Laporan.docx');
            $templateProcessor->setValue('nama', $data->nama);
            $templateProcessor->setValue('nim', $data->nim);
            $templateProcessor->setValue('dosen_pembimbing_utama', $data->dosen_pembimbing_utama);
            $templateProcessor->setValue('tahun_masuk', $data->tahun_masuk);
            $templateProcessor->setValue('jenjang_studi', $data->jenjang_studi);

            $templateProcessor->setValue('dpa_1', $data->dosenPembimbings[0]->nama);
            $templateProcessor->setValue('dpa_2', $data->dosenPembimbings[1]->nama);
            $templateProcessor->setValue('dpa_3', $data->dosenPembimbings[2]->nama);

            foreach ($data->answers as $answer) {
                if ($answer->question->type == "radio") {
                    $val = is_null($answer->answer) ? ' - ' : $answer->answer == '1' ? 'Ya' : 'Tidak';
                    $templateProcessor->setValue($answer->question->slug, $val);
                } elseif ($answer->question->type == "multitext") {
                    $mk = MataKuliah::where('id_mahasiswa', $data->id)->get();
                    foreach ($mk as $i => $matkul) {
                        $val = !is_null($matkul->mata_kuliah) ? $matkul->mata_kuliah : '';
                        $templateProcessor->setValue('mata_kuliah_belum_' . ($i + 1), $val);
                    }
                } else {
                    $templateProcessor->setValue($answer->question->slug, is_null($answer->answer) ? '' : $answer->answer);
                }
            }

            $export_file = public_path("Formulir Pengajuan Pascasarjana $data->nim.docx");

            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        } catch (CopyFileException $e) {
        } catch (CreateTemporaryFileException $e) {
        }

        return $data;
    }

    public function getUploadPage()
    {
        return view('upload');
    }

    public function storeUpload(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|numeric',
            'nama' => 'required',
            'file' => 'required|file|mimes:pdf|max:15360'
        ]);

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->where('nama', $request->nama)->first();

        if (is_null($mahasiswa)) {
            toastr()->error('error', 'NIM atau Nama tidak tersedia');
            return redirect()->back();
        }

        $file = $request->file('file');
        $path = $file->store('public/files');

        $temp_upload = Upload::where('id_mahasiswa', $mahasiswa->id)->get();
        if (count($temp_upload) > 0) {
            toastr()->error('Anda sudah mengupload file sebelumnya');
            return redirect()->back();
        }

        Upload::create([
            'id' => uniqid(),
            'id_mahasiswa' => $mahasiswa->id,
            'file_path' => $path
        ]);

        toastr()->success('File berhasil diupload');
        return redirect()->back();
    }

    public function getForm1()
    {
        $sumber_dana_penelitian = ['Biaya Pribadi', 'Beasiswa', 'Subsidi pihak ketiga'];
        $sections = \App\Section::with('questions')->where('id', '<', 13)->get();
        return view('form-1', compact('sections', 'sumber_dana_penelitian'));
    }

    public function getForm2()
    {
        $sumber_dana_penelitian = ['Biaya Pribadi', 'Beasiswa', 'Subsidi pihak ketiga'];
        $sections = \App\Section::with('questions')->where('id', '>=', 13)->get();
        return view('form-2', compact('sections', 'sumber_dana_penelitian'));
    }
}
