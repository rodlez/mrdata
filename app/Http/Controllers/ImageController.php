<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
// Models
use App\Models\Note;
use App\Models\Image;
// Services
use App\Services\NoteService;

class ImageController extends Controller
{

    // Service Injection
    public function __construct(private NoteService $noteService) {}

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
    public function store(Request $request, int $noteId)
    {
        $note = Note::find($noteId);

        $request->validate([
            'image' => 'required|mimes:pdf,jpeg,png,jpg,gif|max:2048',
        ]);

        $original_filename = $request->file('image')->getClientOriginalName();
        $randomFilename = bin2hex(random_bytes(16));
        $fileExtension = $request->file('image')->getClientOriginalExtension();
        $storage_filename = $randomFilename . "." . $fileExtension;
        $media_type = $request->file('image')->getMimeType();
        $size = $request->file('image')->getSize();
        $path = '/upload/' . $storage_filename;

        $data = [
            'note_id' =>  $noteId,
            'original_filename' => $original_filename,
            'storage_filename' => $storage_filename,
            'path' => $path,
            'media_type' => $media_type,
            'size' =>  $size
        ];

        // using store method
        // store image in the storage/app/uploaded_images folder
        //$path = $request->file('image')->storeAs('upload_images', $storage_filename);

        // using move method to upload in a specific path
        $request->file('image')->move(public_path('upload'), $storage_filename);
        //$request->file('image')->move($path);

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

        $this->noteService->deleteOneImage($image);

        //File::delete(public_path('upload'), $image->storage_filename);

        return to_route('note.show', $note)->with('message', 'Image ' . $image->original_filename . ' for : ' . $note->title . ' deleted.');
    }

    public function download(string $noteId, string $imageId, string $imageDown)
    {
        $note = Note::find($noteId);
        $image = Image::find($imageId);

        $path = public_path('upload/' . $image->storage_filename);

        // To download we will change the name of the storage filename to his original
        // by default the browser send HTML files, we need to change the header to tell the browser that we will send a file
        header("Content-Disposition: {$imageDown};filename={$image->original_filename}");
        header("Content-Type: {$image->media_type}");

        readfile($path);
    }
}
