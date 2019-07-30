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

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|numeric',
            'dosen_pembimbing_utama' => 'required',
            'tahun_masuk' => 'required|numeric',
            'jenjang_studi' => 'required|min:1|max:5'
        ]);

        if(isset($request->mata_kuliah_belum)){
            if(count($request->mata_kuliah_belum) > 10){
                toastr()->error('Maksimum mata kuliah yang dipilih hanya 10');
                return redirect()->back();
            }
        }

        $mahasiswa = Mahasiswa::create($request->all());
        foreach ($request->dosen_pembimbing_anggota as $dosen) {
            DosenPembimbing::create([
                'id_mahasiswa' => $mahasiswa->id,
                'nama' => $dosen
            ]);
        }

        foreach ($request->mata_kuliah_belum as $id_matkul) {
            MataKuliah::create([
                'id_mahasiswa' => $mahasiswa->id,
                'id_mata_kuliah' => $id_matkul
            ]);
        }

        $temp = $this->removeUsedParams($request);
        foreach ($temp->request as $index => $var) {
            Answer::create([
                'id_question' => Question::where('slug', $index)->first()->id,
                'id_mahasiswa' => $mahasiswa->id,
                'answer' => $var
            ]);
        }

        return $this->getForm($mahasiswa->id);
    }

    public function getForm($id)
    {
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
                } elseif ($answer->question->type == "checkbox") {
                    $mk = MataKuliah::where('id_mahasiswa', $data->id)->get();
                    $temp = 0;
                    foreach ($mk as $i => $matkul){
                        $val = !is_null($matkul->mata_kuliah) ? $matkul->mata_kuliah : '';
                        $templateProcessor->setValue('mata_kuliah_belum_' . ($i + 1), $val);
                        $temp++;
                    }

                    for($i=$temp; $i<=(int) $answer->question->prop; $i++){
                        $templateProcessor->setValue('mata_kuliah_belum_' . ($i), '');
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

    private function removeUsedParams(Request $request)
    {
        $request->request->remove('_token');
        $request->request->remove('nama');
        $request->request->remove('nim');
        $request->request->remove('dosen_pembimbing_utama');
        $request->request->remove('dosen_pembimbing_anggota');
        $request->request->remove('tahun_masuk');
        $request->request->remove('jenjang_studi');
        $request->request->remove('mata_kuliah_belum_lulus');

        $questions = Question::select(['id', 'slug'])->get();
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
                    foreach ($mk as $i => $matkul){
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

    public function getUploadPage(){
        return view('upload');
    }

    public function storeUpload(Request $request){
        $this->validate($request, [
            'nim' => 'required|numeric',
            'nama' => 'required',
            'file' => 'required|file|mimes:pdf'
        ]);

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->where('nama', $request->nama)->first();

        if(is_null($mahasiswa)){
            toastr()->error('error', 'NIM atau Nama tidak tersedia');
            return redirect()->back();
        }

        $file = $request->file('file');
        $path = $file->store('public/files');

        $temp_upload = Upload::where('id_mahasiswa', $mahasiswa->id)->get();
        if(count($temp_upload) > 0){
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
}
