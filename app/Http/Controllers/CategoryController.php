<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  ->where('user_id', request()->user()->id) to show only the categories for the user

        $categories = Category::query()
            //->where('user_id', request()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        //dd($categories);
        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:categories,name']
        ]);
        //dd($data);
        //$data['user_id'] = $request->user()->id;
        $category = Category::create($data);
        //dd($category);

        return to_route('category.show', $category)->with('message', 'Category was created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        /* resticted access - only user who owns the category has access
        if ($category->user_id !== request()->user()->id) {
            abort(403);
        }*/

        return view('category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        /* resticted access - only user who owns the category has access
        if ($category->user_id !== request()->user()->id) {
            abort(403);
        }*/

        return view('category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        /* resticted access - only user who owns the category has access
        if ($category->user_id !== request()->user()->id) {
            abort(403);
        }*/

        $data = $request->validate([
            'name' => ['required', 'string', 'unique:categories,name,{$this->category->id}']
        ]);

        $category->update($data);

        return to_route('category.show', $category)->with('message', 'category was updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        /* resticted access - only user who owns the category has access
        if ($category->user_id !== request()->user()->id) {
            abort(403);
        }*/

        $category->delete();

        return to_route('category.index')->with('message', 'category: ' . $category->name . ' deleted.');
    }
}
