<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Models
use App\Models\Note;
use App\Models\Image;

class ImageController extends Controller
{
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

        $data = [
            'note_id' =>  $noteId,
            'original_filename' => $original_filename,
            'storage_filename' => $storage_filename,
            'media_type' => $media_type,
            'size' =>  $size
        ];

        // store image in the storage/app/uploaded_images folder
        $path = $request->file('image')->storeAs('upload_images', $storage_filename);

        $image = Image::create($data);

        return to_route('note.show', $note)->with('message', 'Image for (' . $note->title . ') uploaded.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //$note->delete();

        //return to_route('note.index')->with('message', 'Note: ' . $note->title . ' deleted.');
    }
}
