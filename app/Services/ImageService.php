<?php

namespace App\Services;

// Models
use App\Models\Tag;
use App\Models\Image;
use App\Models\Note;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteRequest;
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
        $path = public_path('upload/' . $image->storage_filename);

        if (File::exists($path)) {
            unlink($path);
            $image->delete();
        }
    }
}


    /* public function storeTag(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', 'string', 'unique:tags,name']
        ]);

        try {

            Tag::create($data);

            $result = [
                'status' => 'success',
                'message' => 'Tag (' . $request->input('name') . ') created'
            ];
        } catch (QueryException $exception) {

            Log::error('Error storing the Tag (' . $request->input('name') . '):' . $exception->getMessage());

            $result = [
                'status' => 'error',
                'message'  => 'Tag (' . $request->input('name') . ') could not be created'
            ];
        }
        return $result;
    }

    public function updateTag(Request $request, Tag $tag): array
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', 'string', 'unique:tags,name']
        ]);

        try {
            //$caca = ['truño' => 'grande'];
            // This way if can Not update, e.g the column does NOT exists, will throw an exception
            Tag::where('id', $tag->id)->update($data);
            //$tag->update($data);
            $result = [
                'status' => 'success',
                'message' => 'Tag (' . $request->input('name') . ') updated'
            ];
        } catch (Exception $exception) {

            Log::error('Error updating the Tag (' . $request->input('name') . '):' . $exception->getMessage());

            $result = [
                'status' => 'error',
                'message'  => 'Tag (' . $request->input('name') . ') could not be updated'
            ];
        }
        return $result;
    }

    public function deleteTag(Tag $tag): array
    {
        $tagDeleted = $tag->name;
        $caca = new Tag();
        try {

            $deleted = $caca->delete();
            dd($deleted);

            $result = [
                'status' => 'success',
                'message' => 'Tag (' . $tagDeleted . ') deleted'
            ];
        } catch (Exception $exception) {

            Log::error('Error deleting the Tag (' . $tagDeleted . '):' . $exception->getMessage());

            $result = [
                'status' => 'error',
                'message'  => 'Tag (' . $tagDeleted . ') could not be deleted'
            ];
        }

        return $result;
    } */
