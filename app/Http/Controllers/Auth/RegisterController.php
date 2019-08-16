<?php

namespace App\Http\Controllers\Auth;

use App\Mahasiswa;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'no_hp' => ['required', 'numeric'],
            'nim' => ['required', 'numeric', 'digits_between:10,15'],
            'alamat' => ['required'],
            'universitas' => ['required'],
            'fakultas' => ['required'],
            'prodi' => ['required'],
            'semester' => ['required', 'numeric', 'min:1', 'max:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        \DB::transaction(function() use ($data){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ])->assign('mahasiswa');

            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $data['nim'],
                'alamat' => $data['alamat'],
                'universitas' => $data['universitas'],
                'fakultas' => $data['fakultas'],
                'prodi' => $data['prodi'],
                'semester' => $data['semester'],
                'no_hp' => $data['no_hp']
            ]);

            return $user;
        });
    }
}
