<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_mahasiswa
 * @property int $id_mata_kuliah
 * @property Mahasiswa $mahasiswa
 * @property BaseMataKuliah $baseMataKuliah
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
    protected $fillable = ['id_mahasiswa', 'id_mata_kuliah'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function baseMataKuliah()
    {
        return $this->belongsTo('App\BaseMataKuliah', 'id_mata_kuliah');
    }
}
