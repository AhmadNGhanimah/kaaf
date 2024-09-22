<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }
    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'smallDescription' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->smallDescription = $request->smallDescription;
        $category->price = $request->price;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/category');
            $image->move($destinationPath, $name);
            $category->image = $name;
        }

        $category->save();

        return redirect('admin/category')->with('success', 'Category created successfully');
    }

    public function edit(Category $category_id)
    {

        return view('admin.category.edit', compact('category_id'));
    }
    public function update(Request $request, $category_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'smallDescription' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::findOrFail($category_id);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->smallDescription = $request->smallDescription;
        $category->price = $request->price;

        if ($request->hasFile('image')) {
            $oldImagePath = public_path('uploads/category/' . $category->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/category');
            $image->move($destinationPath, $name);
            $category->image = $name;
        }

        $category->save();

        return redirect('admin/category')->with('success', 'Category updated successfully');
    }


    public function delete(Category $category_id) {}
}
