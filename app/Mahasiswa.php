<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['nama', 'nim', 'dosen_pembimbing_utama', 'tahun_masuk', 'jenjang_studi'];

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
}
