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

class BrandController extends Controller
{
    public function brands(Request $request)
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);

        return view('admin.brands.brands', ['brands' => $brands]);
    }

    public function add_brands(Request $request)
    {
        return view('admin.brands.brands-add');
    }

    public function brand_store(Request $request)
    {
        $data = [
            'name' => 'required|unique:brands,name',
            'slug' => 'required|unique:brands,slug',
            'image' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2048']
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
            $image->storeAs('uploads/brands', $imageName, 'public');
        }

        // Create the brand, image will be null if no image is uploaded
        Brand::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.brands')->with('success', 'Brand added successfully!');
    }


    public function brand_edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brands.brands-edit', ['brand' => $brand]);
    }
    public function brand_update(Request $request, $id)
    {
        $data = [
            'name' => 'required',
            'slug' => 'required|unique:brands,slug',
            'image' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2048']
        ];

        $validator = validator($data);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }


        $brand = Brand::findOrFail($id);

        // Initialize imageName as null for cases where no image is provided
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/brands', $imageName, 'public');
            if ($brand->image && Storage::disk('public')->exists('uploads/brands/' . $brand->image)) {
                Storage::disk('public')->delete('uploads/brands/' . $brand->image);
            }

            $brand->image = $imageName;
        }

        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->save();
        return redirect()->route('admin.brands')->with('success', 'Brand updated successfully!');





        // return redirect()->route('admin.brands')->with('success', 'Brand added successfully!');
    }
    public function destroyBrands(Request $request, $id)
    {
        $brand =  Brand::findOrFail($id);
        if ($brand->image && Storage::disk('public')->exists('uploads/brands/' . $brand->image)) {
            Storage::disk('public')->delete('uploads/brands/' . $brand->image);
        }

        $brand->delete();

        return redirect()->route('admin.brands')->with('success', 'Brand Delete successfully!');
    }
}
