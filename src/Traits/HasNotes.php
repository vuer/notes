<?php

namespace Vuer\Notes\Traits;

use Illuminate\Database\Eloquent\Model;
use Vuer\Notes\Models\User;

trait HasNotes
{
    /**
     * Relation to MANY notes.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notes()
    {
        return $this->morphMany(config('notes.note_model'), 'noteable');
    }

    /**
     * Relation to ONE note.
     * @return \Vuer\Notes\Models\Note
     */
    public function note()
    {
        return $this->morphOne(config('notes.note_model'), 'noteable');
    }

    /**
     * Save a new note and return the instance.
     * @param  array $attributes
     * @param  \Illuminate\Database\Eloquent\Model $author
     * @return static
     */
    public function createNote($attributes, $author = null)
    {
        if ($author) {
            $attributes['author_id'] = $author->id;
            if (method_exists($author, 'getNotesAuthorName')) {
                $attributes['author_name'] = $author->getNotesAuthorName();
            }
        }

        return $this->notes()->create($attributes);
    }

    /**
     * Find one note by $primaryKey.
     * @param int $id
     * @param string $primaryKey
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findNote($id, $primaryKey = 'id')
    {
        return $this->notes()->where($primaryKey, $id)->first();
    }
}
