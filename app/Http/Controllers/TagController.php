<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::query()
            //->where('user_id', request()->user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('tag.index', ['tags' => $tags]);
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
        $data = $request->validate([
            'name' => ['required', 'min:3', 'string', 'unique:tags,name']
        ]);
        //dd($data);
        //$data['user_id'] = $request->user()->id;
        $tag = Tag::create($data);

        return to_route('tag.index', $tag)->with('message', 'Tag (' . $tag->name . ') created.');
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
        $data = $request->validate([
            'name' => ['required', 'min:3', 'string', 'unique:tags,name,{$this->tag->id}']
        ]);

        $tag->update($data);

        return to_route('tag.show', $tag)->with('message', 'Tag Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return to_route('tag.index')->with('message', 'Tag: ' . $tag->name . ' deleted.');
    }
}
