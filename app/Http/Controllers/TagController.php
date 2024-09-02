<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

// Services
use App\Services\TagService;

class TagController extends Controller
{

    // Service Injection
    public function __construct(private TagService $tagService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Use livewire component TagPagination to display the Tags
        return view('tag.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Use livewire component CreateTag
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('tag.show', ['tag' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tag.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTagRequest $request, Tag $tag)
    {
        $formData = $request->validated();
        Tag::where('id', $tag->id)->update($formData);
        return to_route('tag.index')->with('message', 'Tag (' . $request->input('name') . ') updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $deletedTag = $tag->name;
        $tag->delete();
        return to_route('tag.index')->with('message', 'Tag (' . $deletedTag . ') deleted.');
    }
}
