<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property string $nama
 * @property string $nim
 * @property string $dosen_pembimbing_utama
 * @property int $tahun_masuk
 * @property string $jenjang_studi
 * @property Answer[] $answers
 * @property DosenPembimbing[] $dosenPembimbings
 * @property MataKuliah[] $mataKuliahs
 */
class Mahasiswa extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'mahasiswa';

    /**
     * @var array
     */
    protected $fillable = ['nama', 'user_id', 'nim', 'alamat', 'universitas', 'fakultas', 'prodi', 'semester', 'no_hp', 'form1', 'form2'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Answer', 'id_mahasiswa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dosenPembimbings()
    {
        return $this->hasMany('App\DosenPembimbing', 'id_mahasiswa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mataKuliahs()
    {
        return $this->hasMany('App\MataKuliah', 'id_mahasiswa');
    }

    public function getAnswers(){
        return Question::with('answers')->whereHas('answers', function($q){
            $q->where('id_mahasiswa', 12);
        })->get();
    }

    public static function getForm1Status(){
        return Mahasiswa::where('user_id', Auth::id())->firstOrFail()->form1;
    }

    public static function getForm2Status(){
        return Mahasiswa::where('user_id', Auth::id())->firstOrFail()->form2;
    }
}
