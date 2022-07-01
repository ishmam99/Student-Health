<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('backend.category.add-category', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255', Rule::unique('categories', 'name')],
            'image' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp,gif', 'max:1024'],
        ]);

        $category = Category::create($validated);
        if ($request->hasFile('image')) {
            $category->addMedia($request->file('image'))->toMediaCollection('image');
        }

        return redirect()->route('category.add')->with('success', 'Category has store Successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit-category', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($id)],
            'image' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp,gif', 'max:1024'],
        ]);

        $category = Category::findOrFail($id);
        if ($request->hasFile('image')) {
            $category->addMedia($request->file('image'))->toMediaCollection('image');
        }
        $category->update($validated);

        return redirect()->route('category.add')->with('success', 'Category has Update Successfully');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.add')->with('success', 'Category has Deleted Successfully');
    }
}
