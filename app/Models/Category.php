<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // protected array with the keys that are valid, when create method get the data array will have access to this keys
    protected $fillable = [
        'name'
    ];

    /**
     * Get the note that has the category.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
