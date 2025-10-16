<?php

namespace App\Http\Controllers;

use App\Models\Brand;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class ShopController extends Controller
{

    public function index(Request $request)
    {
        $page_size = $request->query('size') ? $request->query('size') : 9;
        $order = $request->query('order') ? $request->query('order') : '-1';
        $o_column = "";
        $o_order = "";
        $f_brands = $request->query('brands', []);
        $brandIds = is_array($f_brands) ? $f_brands : explode(',', $f_brands);

        $f_categories = $request->query('categories', []);
        $categoryIds = is_array($f_categories) ? $f_categories : explode(',', $f_categories);

        $sizeFilters = $request->query('sizes', []);
        $sizeFilters = is_array($sizeFilters) ? $sizeFilters : explode(',', $sizeFilters);


        $min_price = $request->query('min') ? $request->query('min') : 1;
        $max_price = $request->query('max', 5000);

        switch ($order) {
            case '1':
                $o_column = "created_at";
                $o_order = "DESC";
                break;
            case '2':
                $o_column = "created_at";
                $o_order = "ASC";
                break;
            case '3':
                $o_column = "sale_price";
                $o_order = "ASC";
                break;
            case '4':
                $o_column = "sale_price";
                $o_order = "DESC";
                break;
            default:
                $o_column = "created_at";
                $o_order = "DESC";
                break;
        }

        $brands = Brand::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();

        $products = Product::when(!empty($brandIds), function ($query) use ($brandIds) {
            $query->whereIn('brand_id', $brandIds);
        })
            ->when(!empty($categoryIds), function ($query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds);
            })
            ->when(!empty($sizeFilters), function ($query) use ($sizeFilters) {
                $query->where(function ($q) use ($sizeFilters) {
                    foreach ($sizeFilters as $size) {
                        $q->orWhereJsonContains('sizes', $size);
                    }
                });
            })
            ->when($min_price, function ($query) use ($min_price) {
                $query->whereRaw('COALESCE(sale_price, regular_price) >= ?', [$min_price]);
            })
            ->when($max_price, function ($query) use ($max_price) {
                $query->whereRaw('COALESCE(sale_price, regular_price) <= ?', [$max_price]);
            })
            ->orderBy($o_column, $o_order)
            ->paginate($page_size);


        if ($request->ajax()) {
            return response()->json([
                'products' => view('partials.product-list', compact('products'))->render(),
                'pagination' => $products->appends($request->except('page'))->links('pagination::custom-pagination')->render()
            ]);
        }



        return view('Website.shop', [
            'products' => $products,
            'brands' => $brands,
            'page_size' => $page_size,
            'order' => $order,
            'f_brands' => $brandIds,
            'categories' => $categories,
            'f_categories' => $categoryIds,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'f_sizes' => $sizeFilters, // ফিল্টার করা সাইজ ডাটা পাঠানো হচ্ছে
        ]);
    }

    public function product_details($product_slug)
    {
        // Retrieve the product by its slug
        $product = Product::where('slug', $product_slug)->first();

        // Get related products (excluding the current product)
        $relatedproducts = Product::where('category_id', $product->category_id)
            ->where('id', '<>', $product->id)
            ->limit(8)
            ->get();


        // Paginate the reviews (5 reviews per page)
        $reviews = $product->reviews()->paginate(5);

        // If it's an AJAX request, return only the reviews and pagination
        if (request()->ajax()) {
            return response()->json([
                'reviews' => view('partials.reviews', ['reviews' => $reviews])->render(),
                'pagination' => $reviews->links('pagination::bootstrap-5')->render(), // Bootstrap 5 pagination
            ]);
        }

        // Return the view with the product, related products, and reviews
        return view('Website.details', [
            'product' => $product,
            'relatedproducts' => $relatedproducts,
            'reviews' => $reviews,
        ]);
    }
}
