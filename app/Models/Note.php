<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    // protected array with the keys that are valid, when create method get the data array will have access to this keys
    protected $fillable = [
        'title',
        'url',
        'info',
        'comment',
        'rating',
        'date',
        'date_limit',
        'category_id',
        'pending',
        'user_id'
    ];

    /**
     * Get the user associated with the note.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category associated with the note.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the tags associated with the note.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'note_tag');
    }
}
