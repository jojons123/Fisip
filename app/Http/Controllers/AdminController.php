<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\MataKuliah;
use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function index()
    {
        return view('admin.dashboard');
    }

    public function detailMahasiswa($id)
    {
        return $this->printForm($id);
//        return redirect('/');
    }

    public function getDataMahasiswa()
    {
        $data = Mahasiswa::get();
        foreach ($data as $i => $d) {
            $d->nama = $d->user->name;
            $d->no = $i + 1;
            $d->tanggal = date('d/m/Y', strtotime($d->created_at));
            $d->form_1 = $d->form1 == 1 ? 'Sudah' : 'Belum';
            $d->form_2 = $d->form2 == 1 ? 'Sudah' : 'Belum';
        }

        return DataTables::of($data)
            ->addColumn('action', function ($q) {
                return '<button class="btn btn-danger" onclick="deleteData(\'' . $q->id . '\')" type="button">Delete</button>';
            })->rawColumns(['action'])
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
                        $val = !is_null($matkul->baseMataKuliah->mata_kuliah) ? $matkul->baseMataKuliah->mata_kuliah . ' / ' . $matkul->baseMataKuliah->sks . ' SKS': '';
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

    public function getUploadPage()
    {
        return view('admin.upload');
    }

    public function getDataUpload()
    {
        $data = Upload::with('mahasiswa')->get();
        foreach ($data as $i => $d) {
            $d->no = $i + 1;
            $d->tanggal = date('d/m/Y H:i:s', strtotime($d->created_at));
        }

        return DataTables::of($data)
            ->addColumn('action', function ($q) {
                return ' <button class="btn btn-danger" onclick="deleteFile(\'' . $q->id . '\')" type="button">Delete</button>';
            })->rawColumns(['action'])
            ->make(true);
    }

    public function downloadUploadFile($id)
    {
        $file = Upload::with('mahasiswa')->findOrFail($id);
        return response()->download(storage_path('app/' . $file->file_path), "Formulir fix " . $file->mahasiswa->nim . ".pdf");
    }

    public function deleteUploadFile(Request $request)
    {
        Upload::findOrFail($request->id)->delete();
        return redirect()->back();
    }

    public function deleteMahasiswa($id){
        Mahasiswa::findOrFail($id)->deleteData();
        toastr()->success('Data berhasil dihapus');
        return redirect()->back();
    }
}

