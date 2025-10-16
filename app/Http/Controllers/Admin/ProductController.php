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

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.products.products', ['products' => $products]);
    }

    public function product_add(Request $request)
    {
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        $categories = Category::select('id', 'name')->orderBy('name')->get();

        return view('admin.products.product-add', [
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    public function products_store(Request $request)
    {
        $fields = [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:regular_price',
            'SKU' => 'required|string|max:100|unique:products,SKU',
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'nullable|boolean',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'sizes' => 'nullable|array',
            'sizes.*' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ];

        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            return redirect()->route('admin.product.add')->with('error', 'Validation failed')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Handle single image upload
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('uploads/products', $imageName, 'public');
            }

            // Handle multiple images upload
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('uploads/products/gallery', $fileName, 'public');
                    $imagePaths[] = $fileName;
                }
            }

            // Create the product
            $product = Product::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'regular_price' => $request->regular_price,
                'sale_price' => $request->sale_price,
                'SKU' => $request->SKU,
                'stock_status' => $request->stock_status,
                'featured' => $request->featured ?? false,
                'quantity' => $request->quantity,
                'image' => $imageName,
                'images' => $imagePaths ? json_encode($imagePaths) : null,
                'sizes' => $request->sizes ? json_encode($request->sizes) : json_encode([]),
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
            ]);

            // return redirect()->route('admin.products')->with('success', 'Product created successfully!');
            return Redirect::back();
        } catch (\Exception $e) {
            return redirect()->route('admin.product.add')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }



    public function product_edit($id)
    {
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $product = Product::findOrFail($id);
        return view('admin.products.product-edit', [
            'product' => $product,
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    public function product_update(Request $request, $id)
    {
        // Find the existing product
        $product = Product::findOrFail($id);

        // Validation rules
        $fields = [
            'name' => 'required|string|max:255',
            'slug' => "required|string|unique:products,slug,{$id}|max:255",
            'short_description' => 'nullable|max:500',
            'description' => 'required',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:regular_price',
            'SKU' => "required|string|max:100|unique:products,SKU,{$id}",
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'nullable|boolean',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10000', // Single image validation
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg', // Multiple images validation
            'sizes' => 'nullable|array',
            'sizes.*' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $fields);

        if ($validator->fails()) {
            return redirect()->route('admin.product.edit', $id)->with('error', 'Validation fails')
                ->withErrors($validator)
                ->withInput();
        }

        // Handle single image upload
        $imageName = $product->image; // Preserve the old image
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($imageName && Storage::exists('public/uploads/products/' . $imageName)) {
                Storage::delete('public/uploads/products/' . $imageName);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/products', $imageName, 'public');
        }

        // Handle multiple images upload
        $imagePaths = json_decode($product->images, true) ?? []; // Preserve old images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/products/gallery', $fileName, 'public');
                $imagePaths[] = $fileName;
            }
        }

        // Update the product
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'SKU' => $request->SKU,
            'stock_status' => $request->stock_status,
            'featured' => $request->featured ?? false,
            'quantity' => $request->quantity,
            'image' => $imageName, // Updated single image name
            'images' => $imagePaths ? json_encode($imagePaths) : null, // Updated multiple image paths as JSON
            'sizes' => $request->sizes ? json_encode($request->sizes) : json_encode([]),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }


    public function deleteGalleryImage(Product $product, $image)
    {
        $images = json_decode($product->images, true) ?? [];

        // Remove image from array
        $images = array_values(array_filter($images, function ($img) use ($image) {
            return $img !== $image;
        }));

        // Delete physical file
        $imagePath = 'public/uploads/products/gallery/' . $image;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        // Update database
        $product->images = json_encode($images);
        $product->save();

        return back()->with('success', 'Image deleted successfully');
    }


    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        // Delete single product image
        if ($product->image) {
            $singleImagePath = 'public/uploads/products/' . $product->image;
            if (Storage::exists($singleImagePath)) {
                Storage::delete($singleImagePath);
            }
        }

        // Delete gallery images
        $galleryImages = json_decode($product->images, true) ?? [];
        foreach ($galleryImages as $galleryImage) {
            $galleryImagePath = 'public/uploads/products/gallery/' . $galleryImage;
            if (Storage::exists($galleryImagePath)) {
                Storage::delete($galleryImagePath);
            }
        }

        // Delete product from database
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product and its images deleted successfully!');
    }
}
