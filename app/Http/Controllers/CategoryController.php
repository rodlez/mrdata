<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Use livewire component CategoryPagination to display the categories

        return view('category.index');
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
        // Use livewire component CreateCategory
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
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $formData = $request->validated();
        Category::where('id', $category->id)->update($formData);
        return to_route('category.show', $category)->with('message', 'Category (' . $request->input('name') . ') updated.');
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
