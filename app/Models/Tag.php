<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * Get the notes associated with the tag.
     */
    public function notes()
    {
        return $this->belongsToMany(Note::class, 'note_tag');
    }
}
