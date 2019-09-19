<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Mahasiswa;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;

class MahasiswaController extends Controller
{
    public function index(){
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        return view('mahasiswa.dashboard', compact('user', 'mahasiswa'));
    }

    public function updateProfile(Request $request){
        if(is_null($request->password)){
            $request->request->remove('password');
        } else {
            $request->password = bcrypt($request->password);
        }

        if($request->email == Auth::user()->email){
            $request->request->remove('email');
        }

        $this->validate($request, [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'string|min:8',
            'no_hp' => 'numeric',
            'nim' => 'numeric|digits_between:10,15',
            'alamat' => '',
            'universitas' => '',
            'fakultas' => '',
            'prodi' => '',
            'semester' => 'numeric|min:1|max:8',
        ]);

        \DB::transaction(function() use ($request){
            $user = Auth::user();
            User::findOrFail($user->id)->update($request->all());
            Mahasiswa::where('user_id', $user->id)->firstOrFail()->update($request->all());
        });

        toastr()->success('Data Berhasil Diubah');
        return redirect()->back();
    }

    public function showEditForm1(){
        $data = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        if($data->form1 != 1){
            toastr()->warning('Something error');
            return redirect('/dashboard');
        }
        $sumber_dana_penelitian = ['Biaya Pribadi', 'Beasiswa', 'Subsidi pihak ketiga'];
        $sections = \App\Section::with('questions')->where('id', '<', 13)->get();
        $answers = Answer::where('id_mahasiswa', Mahasiswa::where('user_id', Auth::id())->first()->id)->get();
        return view('mahasiswa.form-1', compact('sumber_dana_penelitian', 'sections', 'answers'));
    }

    public function showEditForm2(){
        $data = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        if($data->form2 != 1){
            toastr()->warning('Something error');
            return redirect('/dashboard');
        }
        $sections = \App\Section::with('questions')->where('id', '>=', 13)->get();
        $answers = Answer::where('id_mahasiswa', Mahasiswa::where('user_id', Auth::id())->first()->id)->get();
        return view('mahasiswa.form-2', compact('sections', 'answers'));
    }

    public function updateForm1(Request $request){
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        $printable = $request->print;
        $temp = $this->removeUsedParamsForm1($request);
        try {
            DB::beginTransaction();
            foreach ($temp->request as $index => $var) {
                $t = explode('_', $index);
                if($t[count($t)-1] == "etc"){
                    // TODO : etc
                    continue;
                }
                $question = Question::where('slug', $index)->first();
                $answer = Answer::where('id_mahasiswa', $mahasiswa->id)->where('id_question', $question->id)->first();
                if(is_null($answer)){
                    Answer::create([
                        'id_question' => Question::where('slug', $index)->first()->id,
                        'id_mahasiswa' => $mahasiswa->id,
                        'answer' => $var
                    ]);
                }
                $answer = Answer::where('id_mahasiswa', $mahasiswa->id)->where('id_question', $question->id)->first()->update([
                    'answer' => $var
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Ada sesuatu yang error');
            return redirect()->back();
        }
        if($printable == 1){
            return $this->printForm1();
        }
        toastr()->success('Form berhasil diubah');
        return redirect()->back();
    }

    public function updateForm2(Request $request){
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        $printable = $request->print;
        $temp = $this->removeUsedParamsForm1($request);
        try {
            DB::beginTransaction();
            foreach ($temp->request as $index => $var) {
                $t = explode('_', $index);
                if($t[count($t)-1] == "etc"){
                    // TODO : etc
                    continue;
                }
                $question = Question::where('slug', $index)->first();
                $answer = Answer::where('id_mahasiswa', $mahasiswa->id)->where('id_question', $question->id)->first();
                if($question->type == "checkbox"){
                    $var = json_encode($var);
                }
                if(is_null($answer)){
                    Answer::create([
                        'id_question' => Question::where('slug', $index)->first()->id,
                        'id_mahasiswa' => $mahasiswa->id,
                        'answer' => $var
                    ]);
                }
                $answer = Answer::where('id_mahasiswa', $mahasiswa->id)->where('id_question', $question->id)->first()->update([
                    'answer' => $var
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Ada sesuatu yang error');
            return redirect()->back();
        }
        if($printable == 1){
            return $this->printForm2();
        }
        toastr()->success('Form berhasil diubah');
        return redirect()->back();
    }

    public function printForm1(){
        $mahasiswa = Auth::user()->mahasiswa;

        try {
            $templateProcessor = new TemplateProcessor(public_path('form 1.docx'));

            $templateProcessor->setValue('nama', $mahasiswa->user->name);
            $templateProcessor->setValue('alamat', $mahasiswa->alamat);
            $templateProcessor->setValue('universitas', $mahasiswa->universitas);
            $templateProcessor->setValue('fakultas', $mahasiswa->fakultas);
            $templateProcessor->setValue('prodi', $mahasiswa->prodi);
            $templateProcessor->setValue('semester', $mahasiswa->nama);
            $templateProcessor->setValue('no_hp', $mahasiswa->no_hp);
            $templateProcessor->setValue('email', $mahasiswa->user->email);

            foreach (Question::where('section', '<', 13)->get() as $question){
                $answer = $question->answers->where('id_mahasiswa', $mahasiswa->id)->first();
                if($question->type == "radio"){
                    $templateProcessor->setValue($question->slug, is_null($answer) ? '' : ($answer->answer == 1 ? "Ya" : "Tidak"));
                } else {
                    $templateProcessor->setValue($question->slug, is_null($answer) ? '' : $answer->answer);
                }

            }
            $export_file = public_path("Formulir 1 - $mahasiswa->nim.docx");
            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        } catch (CopyFileException $e) {
        } catch (CreateTemporaryFileException $e) {
        }
    }

    public function printForm2(){
        $mahasiswa = Auth::user()->mahasiswa;

        try {
            $templateProcessor = new TemplateProcessor(public_path('form 2.docx'));

            $templateProcessor->setValue('nama', $mahasiswa->user->name);
            $templateProcessor->setValue('alamat', $mahasiswa->alamat);
            $templateProcessor->setValue('universitas', $mahasiswa->universitas);
            $templateProcessor->setValue('fakultas', $mahasiswa->fakultas);
            $templateProcessor->setValue('prodi', $mahasiswa->prodi);
            $templateProcessor->setValue('semester', $mahasiswa->nama);
            $templateProcessor->setValue('no_hp', $mahasiswa->no_hp);
            $templateProcessor->setValue('email', $mahasiswa->user->email);

            foreach (Question::where('section', '>=', 13)->get() as $question){
                $answer = $question->answers->where('id_mahasiswa', $mahasiswa->id)->first();
                if($question->type == "radio"){
                    $templateProcessor->setValue($question->slug, is_null($answer) ? '' : ($answer->answer == 1 ? "Ya" : "Tidak"));
                } else {
                    $templateProcessor->setValue($question->slug, is_null($answer) ? '' : $answer->answer);
                }

            }
            $export_file = public_path("Formulir 2 - $mahasiswa->nim.docx");
            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        } catch (CopyFileException $e) {
        } catch (CreateTemporaryFileException $e) {
        }
    }

    private function removeUsedParamsForm1(Request $request)
    {
        $request->request->remove('_token');
        $request->request->remove('print');
        $questions = Question::select(['id', 'slug'])->where('section', '<', 13)->get();
        foreach ($questions as $question) {
            if (!$request->has($question->slug)) {
                $request->request->set($question->slug, null);
            }
        }
        return $request;
    }
}
