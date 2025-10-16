<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function categories(Request $request)
    {

        $categories = Category::orderBy('id', 'DESC')->paginate(5);
        return view('admin.categories.categories', ['categories' => $categories]);
    }

    public function category_add(Request $request)
    {
        $brand = Brand::select('id', 'name')->get();
        return view('admin.categories.category-add', [
            'brands' => $brand
        ]);
    }

    public function category_store(Request $request)
    {
        $data = [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'image' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];

        $validator = validator($request->all(), $data);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Initialize imageName as null for cases where no image is provided
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/categories', $imageName, 'public');
        }

        // Create the brand, image will be null if no image is uploaded
        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imageName,

        ]);
        return redirect()->route('admin.categories')->with('success', 'Category Add successfully!');
    }

    public function category_edit($id)
    {

        $categories = Category::findOrFail($id);
        return view('admin.categories.categories-edit', ['categories' => $categories]);
    }

    public function category_update(Request $request, $id)
    {
        $data = [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'image' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2048']
        ];

        $validator = validator($data);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }


        $category = Category::findOrFail($id);

        // Initialize imageName as null for cases where no image is provided
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/categories', $imageName, 'public');

            if ($category->image && Storage::disk('public')->exists('uploads/categories/' . $category->image)) {
                Storage::disk('public')->delete('uploads/categories/' . $category->image);
            }



            $category->image = $imageName;
        }

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }

    public function destroyCategory(Request $request, $id)
    {
        $categories = Category::findOrFail($id);
        if ($categories->image && Storage::disk('public')->exists('uploads/categories/' . $categories->image)) {
            Storage::disk('public')->delete('uploads/categories/' . $categories->image);
        }

        $categories->delete();
        return redirect()->route('admin.categories')->with('success', 'Categories Delete successfully!');
    }
}
