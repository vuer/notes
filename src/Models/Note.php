<?php

namespace Vuer\Notes\Models;

use Illuminate\Database\Eloquent\Model;
use Vuer\Notes\ValueObjects\TextObject;

class Note extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'body',
        'author_id',
        'author_name',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = [
        'noteable_id',
        'noteable_type',
    ];

    /**
     * The loaded relationships for the model.
     * @var array
     */
    protected $relations = [
        'author',
    ];

    /**
     * Get all of the owning noteable models.
     * @return Illuminate\Database\Eloquent\Model
     */
    public function noteable()
    {
        return $this->morphTo();
    }

    /**
     * Define a note to author relationship.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(config('notes.author_model'));
    }

    /**
     * Returns value object for $body.
     * @param  string $value
     * @return \Vuer\Notes\ValueObjects\TextObject
     */
    public function getBodyAttribute($value)
    {
        return (new TextObject($value));
    }
}
