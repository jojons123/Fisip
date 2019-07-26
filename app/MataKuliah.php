<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_mahasiswa
 * @property string $mata_kuliah
 * @property Mahasiswa $mahasiswa
 */
class MataKuliah extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'mata_kuliah';

    /**
     * @var array
     */
    protected $fillable = ['id_mahasiswa', 'mata_kuliah'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa');
    }
}
