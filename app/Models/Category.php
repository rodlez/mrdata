<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Get the note that has the category.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
