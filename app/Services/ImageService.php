<?php

namespace App\Services;

// Models
use App\Models\Tag;
use App\Models\Image;
use App\Models\Note;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteRequest;
// Files
use Illuminate\Support\Facades\Storage;
use File;
// Collection
use Illuminate\Database\Eloquent\Collection;
//Exceptions
use Exception;
use Illuminate\Database\QueryException;
use App\Exceptions\CustomException;
// Log
use Illuminate\Support\Facades\Log;
use stdClass;

class ImageService
{

    /**
     * Upload a file and return an array with the info to make the insertion in the DB table Images
     */

    public function uploadImage(Request $request, Note $note, string $disk): array
    {

        $original_filename = $request->file('image')->getClientOriginalName();
        $media_type = $request->file('image')->getMimeType();
        $size = $request->file('image')->getSize();
        // Storage in filesystem file config
        $storage_filename = Storage::disk($disk)->putFile($request->file('image'));

        return [
            'note_id' =>  $note->id,
            'original_filename' => $original_filename,
            'storage_filename' => $storage_filename,
            //'path' => env('UPLOAD_FILES') . '/' . $storage_filename,
            'path' => $storage_filename,
            'media_type' => $media_type,
            'size' =>  $size
        ];
    }

    public function uploadImagePhpOnly(Request $request, Note $note): array
    {

        $original_filename = $request->file('image')->getClientOriginalName();
        $randomFilename = bin2hex(random_bytes(16));
        $fileExtension = $request->file('image')->getClientOriginalExtension();
        $storage_filename = $randomFilename . "." . $fileExtension;
        $media_type = $request->file('image')->getMimeType();
        $size = $request->file('image')->getSize();
        $path = env('UPLOAD_FILES') . '/' . $storage_filename;

        // using move method to upload in a specific path
        $request->file('image')->move(public_path('upload'), $storage_filename);

        return [
            'note_id' =>  $note->id,
            'original_filename' => $original_filename,
            'storage_filename' => $storage_filename,
            'path' => $path,
            'media_type' => $media_type,
            'size' =>  $size
        ];
    }

    /**
     * Download an image, disposition inline(browser) or attacment(download)
     */

    public function downloadImage(Image $image, string $disposition)
    {

        $dispositionHeader = [
            'Content-Disposition' => $disposition
        ];

        if (Storage::disk('public')->exists($image->storage_filename)) {
            return Storage::disk('public')->download($image->storage_filename, $image->original_filename, $dispositionHeader);
        } else {
            die('error');
            return back();
        }
    }

    /**
     * Upload a file and return an array with the info to make the insertion in the DB table Images
     */

    public function downloadImagePhpOnly(Image $image)
    {
        $disposition = 'attachment';
        $path = public_path('storage/' . $image->storage_filename);

        // To download we will change the name of the storage filename to his original
        // by default the browser send HTML files, we need to change the header to tell the browser that we will send a file
        header("Content-Disposition: {$disposition};filename={$image->original_filename}");
        header("Content-Type: {$image->media_type}");

        readfile($path);
    }


    /**
     * Inset new Note and insert the tags in the intermediate table note_tag   
     */
    public function deleteImages(Collection $images)
    {
        foreach ($images as $image) {
            $this->deleteOneImage($image);
        }
    }

    /**
     * Inset new Note and insert the tags in the intermediate table note_tag   
     */
    public function deleteOneImage(Image $image)
    {
        if (Storage::disk('public')->exists($image->storage_filename)) {
            Storage::disk('public')->delete($image->storage_filename);
            $image->delete();
        }
    }

    /**
     * Inset new Note and insert the tags in the intermediate table note_tag   
     */
    public function deleteOneImagePhpOnly(Image $image)
    {
        $path = public_path($image->path);

        if (File::exists($path)) {
            File::delete($path);
            $image->delete();
        }
    }
}
