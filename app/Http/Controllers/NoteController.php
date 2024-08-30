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
// Validation
use App\Http\Requests\StoreNoteRequest;
// Services
use App\Services\NoteService;
use App\Services\ImageService;

class NoteController extends Controller
{
    // Service Injection
    public function __construct(
        private NoteService $noteService,
        private ImageService $imageService
    ) {}

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
        $tags       = Tag::all();

        return view('note.create', [
            'categories'    => $categories,
            'tags'          => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        // Retrieve the validated input data...
        $formData   = $request->validated();
        $allData    = $this->noteService->appendToFormData($request, $formData);
        $note       = $this->noteService->insertNote($allData);

        return to_route('note.index', $note)->with('message', 'Note (' . $note->title . ') created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        $images     = $this->noteService->getImages($note);
        $tags       = $this->noteService->getNoteTags($note);
        $tagsNames  = $this->noteService->getTagsNames($tags);

        return view('note.show', [
            'note'      => $note,
            'tags'      => $tags,
            'tagsNames' => $tagsNames,
            'images'    => $images
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {

        $categories = Category::all();
        $tags = Tag::all();
        $tagsSelected = $this->noteService->getNoteTags($note);

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
    public function update(StoreNoteRequest $request, Note $note)
    {
        // Retrieve the validated input data...
        $formData   = $request->validated();
        $allData    = $this->noteService->appendToFormData($request, $formData);
        $note       = $this->noteService->updateNote($note, $allData);

        return to_route('note.show', $note)->with('message', 'Note (' . $note->title . ') updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $images = $this->noteService->getImages($note);
        $this->imageService->deleteImages($images, $note);
        $note->delete();

        return to_route('note.index')->with('message', 'Note: ' . $note->title . ' deleted.');
    }
}
