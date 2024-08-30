<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use File;

// Models
use App\Models\Note;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Image;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('note.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('note.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->pending);
        $data = $request->validate([
            'title' => ['required', 'min:3', 'string'],
            'url' => ['required', 'min:5', 'string'],
            'info' => ['required', 'min:6', 'string'],
            'comment' => ['required', 'min:4', 'string'],
            'tag' => ['required'],
            'rating' => ['nullable', 'numeric'],
            'date' =>  ['nullable', 'date'],
            'date_limit' =>  ['nullable', 'date'],
            'category_id' => ['required']
        ]);

        // pending boolean
        $request->pending ? $data['pending'] = 1 : $data['pending'] = 0;
        // user_id
        $data['user_id'] = $request->user()->id;
        // tags to insert in the pivot table note_tag
        $tags = $data['tag'];
        //dd($tags);

        // TODO: make a transaction ???
        $note = Note::create($data);
        // insert tags in the pivot table note_tag
        $note->tags()->sync($tags);

        return to_route('note.index', $note)->with('message', 'Note (' . $note->title . ') created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {

        //$note = Note::find($note->id);
        $images = Image::where('note_id', $note->id)
            ->get();

        //dd($images);
        // test get file url to show
        //$url = Storage::url('app/avatars/mK9j2LYsoN5FIRIkUASMG3crcaZvaZzTqOV2CqXP.png');


        $tags = [];
        foreach ($note->tags as $tag) {
            $tags[] = $tag->pivot->tag_id;
        }

        $tagsNames = [];
        foreach ($tags as $tag) {
            $tagsNames[] = Tag::find($tag)->name;
        }

        return view('note.show', [
            'note' => $note,
            'tags' => $tags,
            'tagsNames' => $tagsNames,
            'images' => $images
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {

        $categories = Category::all();
        $tags = Tag::all();

        $tagsSelected = [];
        foreach ($note->tags as $tag) {
            $tagsSelected[] = $tag->pivot->tag_id;
        }

        return view('note.edit', [
            'note' => $note,
            'categories' => $categories,
            'tags' => $tags,
            'tagsSelected' => $tagsSelected
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $data = $request->validate([
            'title' => ['required', 'min:3', 'string'],
            'url' => ['required', 'min:5', 'string'],
            'info' => ['required', 'min:6', 'string'],
            'comment' => ['required', 'min:4', 'string'],
            'tag' => ['required'],
            'rating' => ['nullable', 'numeric'],
            'date' =>  ['nullable', 'date'],
            'date_limit' =>  ['nullable', 'date'],
            'category_id' => ['required']
        ]);

        // pending boolean
        $request->pending ? $data['pending'] = 1 : $data['pending'] = 0;
        // user_id
        $data['user_id'] = $request->user()->id;
        // tags to insert in the pivot table note_tag
        $tags = $data['tag'];
        //dd($tags);

        // TODO: make a transaction ???
        $note->update($data);
        // insert tags in the pivot table note_tag
        //$note->tags()->updateExistingPivot($note->id, $tags);
        $note->tags()->sync($tags);

        return to_route('note.show', $note)->with('message', 'Note (' . $note->title . ') updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $images = Image::where('note_id', $note->id)->get();

        foreach ($images as $image) {
            $path = public_path('upload/' . $image->storage_filename);

            if (File::exists($path)) {
                unlink($path);
                $image->delete();
            }
        }

        $note->delete();

        return to_route('note.index')->with('message', 'Note: ' . $note->title . ' deleted.');
    }
}
