<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use Illuminate\Http\Request;
use File;
// Models
use App\Models\Note;
use App\Models\Image;
// Services
use App\Services\NoteService;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;



class ImageController extends Controller
{

    // Service Injection
    public function __construct(
        private NoteService $noteService,
        private ImageService $imageService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(int $noteId)
    {
        $note = Note::find($noteId);

        return view('image.index', ['note' => $note]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request, int $noteId)
    {
        $note = Note::find($noteId);

        $request->validated();

        $data = $this->imageService->uploadImage($request, $note, 'public');

        Image::create($data);

        return to_route('note.show', $note)->with('message', 'Image for (' . $note->title . ') uploaded.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $noteId, string $imageId)
    {
        $note = Note::find($noteId);
        $image = Image::find($imageId);

        $this->imageService->deleteOneImage($image);

        return to_route('note.show', $note)->with('message', 'Image ' . $image->original_filename . ' for : ' . $note->title . ' deleted.');
    }

    public function download(string $noteId, string $imageId)
    {
        $image = Image::find($imageId);

        return $this->imageService->downloadImage($image, 'attachment');
    }
}
