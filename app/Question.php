<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $section
 * @property string $question
 * @property string $placeholer
 * @property string $type
 * @property string $slug
 * @property Section $secti
 * @property Answer[] $answers
 */
class Question extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'question';

    /**
     * @var array
     */
    protected $fillable = ['section', 'question', 'placeholer', 'type', 'slug', 'priority', 'prop'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo('App\Section', 'section');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Answer', 'id_question');
    }
}
