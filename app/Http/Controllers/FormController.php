<?php

namespace App\Http\Controllers;

use App\Answer;
use App\DosenPembimbing;
use App\Mahasiswa;
use App\MataKuliah;
use App\Question;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class FormController extends Controller
{
    public function index()
    {
        $sections = \App\Section::with('questions')->get();
        return view('form', compact('sections'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::create($request->all());
        foreach ($request->dosen_pembimbing_anggota as $dosen) {
            DosenPembimbing::create([
                'id_mahasiswa' => $mahasiswa->id,
                'nama' => $dosen
            ]);
        }

        foreach ($request->mata_kuliah_belum_lulus as $matkul) {
            MataKuliah::create([
                'id_mahasiswa' => $mahasiswa->id,
                'mata_kuliah' => $matkul
            ]);
        }

        $temp = $this->removeUsedParams($request);
        foreach ($temp->request as $index => $var){
            Answer::create([
                'id_question' => Question::where('slug', $index)->first()->id,
                'id_mahasiswa' => $mahasiswa->id,
                'answer' => $var
            ]);
        }

        return $this->getForm($mahasiswa->id);
        return "NOH";
    }

    public function getForm($id){
        $data = Mahasiswa::with('answers', 'dosenPembimbings', 'mataKuliahs')->findOrFail($id);
        try {
            $templateProcessor = new TemplateProcessor('Template Laporan.docx');
            $templateProcessor->setValue('nama', $data->nama);
            $templateProcessor->setValue('nim', $data->nim);
            $templateProcessor->setValue('dosen_pembimbing_utama', $data->dosen_pembimbing_utama);
            $templateProcessor->setValue('tahun_masuk', $data->tahun_masuk);
            $templateProcessor->setValue('jenjang_studi', $data->jenjang_studi);

            $export_file = public_path('filename.docx');

            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        } catch (CopyFileException $e) {
            return $e;
        } catch (CreateTemporaryFileException $e) {
            return $e;
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


        return $request;
    }
}
