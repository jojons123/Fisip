<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_mahasiswa
 * @property string $nama
 * @property Mahasiswa $mahasiswa
 */
class DosenPembimbing extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'dosen_pembimbing';

    /**
     * @var array
     */
    protected $fillable = ['id_mahasiswa', 'nama'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa');
    }
}
