<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\MataKuliah;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.dashboard');
    }

    public function detailMahasiswa($id){
        return $this->printForm($id);
    }

    public function getDataMahasiswa(){
        $data = Mahasiswa::get();
        foreach ($data as $i => $d){
            $d->no = $i+1;
        }
        return DataTables::of($data)
            ->make(true);
    }


    public function printForm($id)
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

//            return $data->answers;

            foreach ($data->answers as $answer) {
                if ($answer->question->type == "radio") {
                    $val = is_null($answer->answer) ? ' - ' : $answer->answer == '1' ? 'Ya' : 'Tidak';
                    $templateProcessor->setValue($answer->question->slug, $val);
                } elseif ($answer->question->type == "multitext") {
                    $mk = MataKuliah::where('id_mahasiswa', $data->id)->get();
                    foreach ($mk as $i => $matkul){
                        $val = !is_null($matkul->mata_kuliah) ? $matkul->mata_kuliah : '';
                        $templateProcessor->setValue('mata_kuliah_belum_' . ($i+1), $val);
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
}
