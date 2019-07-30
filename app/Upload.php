<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property int $id_mahasiswa
 * @property string $file_path
 * @property string $created_at
 * @property string $updated_at
 * @property Mahasiswa $mahasiswa
 */
class Upload extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['id', 'id_mahasiswa', 'file_path', 'created_at', 'updated_at'];
    protected $dates = ['created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa');
    }
}
