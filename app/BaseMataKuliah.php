<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $mata_kuliah
 * @property int $sks
 */
class BaseMataKuliah extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'base_mata_kuliah';

    /**
     * @var array
     */
    protected $fillable = ['mata_kuliah', 'sks'];

}
