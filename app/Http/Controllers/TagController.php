<?php

namespace App\Http\Controllers;

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
        // Use livewire component tag-pagination to display the Tags
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
        $result = $this->tagService->storeTag($request);

        return to_route('tag.index')->with($result['status'], $result['message']);
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
    public function update(Request $request, Tag $tag)
    {

        $result = $this->tagService->updateTag($request, $tag);

        return to_route('tag.index')->with($result['status'], $result['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $result = $this->tagService->deleteTag($tag);

        return to_route('tag.index')->with($result['status'], $result['message']);
    }
}
