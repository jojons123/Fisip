<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    }

    public function showEditForm2(){
        $data = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        if($data->form2 != 1){
            toastr()->warning('Something error');
            return redirect('/dashboard');
        }
        return "asd";
    }

    public function updateForm1(){
        return "asd";
    }

    public function updateForm2(){

    }

}
