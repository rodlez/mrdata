<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Models
use App\Models\Note;
use App\Models\Category;
use App\Models\Tag;

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
        // category_id
        //$data['category_id'] = $request->category;

        //dd($data);

        $note = Note::create($data);

        return to_route('note.index', $note)->with('message', 'Note (' . $note->title . ') created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note) {}
}
