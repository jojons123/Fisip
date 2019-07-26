<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property Question[] $questions
 */
class Section extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'section';

    /**
     * @var array
     */
    protected $fillable = ['name', 'parent_id', 'visible'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Question', 'section')->orderBy('priority');
    }
}
