<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Database\Query\Expression;

class WishlistController extends Controller
{


    public function index()
    {
        $items = Cart::instance('wishlist')->content();
        // dd($items);
        return view('website.wishlist', [
            'items' => $items
        ]);
    }
    // public function add_to_wishlist(Request $request)
    // {
    //     try {
    //         $cart = Cart::instance('wishlist')->add(
    //             $request->id,
    //             $request->name,
    //             $request->quantity,
    //             $request->price
    //         )->associate('App\Models\Product');

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Product added to wishlist',
    //             'wishlist_count' => Cart::instance('wishlist')->count() // ✅ Wishlist count update
    //         ]);
    //     } catch (\Exception $e) {  // ✅ `Expression` -> `Exception`
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Something went wrong!',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function toggleWishlist(Request $request)
    {
        try {
            // Check if request has ID
            if (!$request->has('id')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product ID is missing!'
                ], 400);
            }

            $wishlist = Cart::instance('wishlist');

            // Check if product already exists
            $existingItem = $wishlist->content()->where('id', $request->id)->first();

            if ($existingItem) {
                // Remove from wishlist
                $wishlist->remove($existingItem->rowId);
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from wishlist',
                    'wishlist_count' => Cart::instance('wishlist')->count(),
                    'action' => 'removed'
                ]);
            } else {
                // Add to wishlist
                $wishlist->add($request->id, $request->name, 1, $request->price)
                    ->associate('App\\Models\\Product');

                return response()->json([
                    'success' => true,
                    'message' => 'Product added to wishlist',
                    'wishlist_count' => Cart::instance('wishlist')->count(),
                    'action' => 'added'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function remove_from_wishlist($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        return redirect()->back()->with('success', 'Product removed from cart');
    }

    public function empty_wishlist()
    {
        Cart::instance('wishlist')->destroy();

        return redirect()->back()->with('success', 'Wishlist cleared');
    }

    public function moveToCut($rowId, Request $request)
    {
        $item = Cart::instance('wishlist')->get($rowId);

        $product = Product::find($item->id);
        Cart::instance('wishlist')->remove($rowId);
        $cart = Cart::instance('cart')->add($item->id, $item->name, $item->qty, $item->price, ['size' => $request->size])->associate('App\Models\Product');
        // dd($cart);
        return redirect()->back()->with('success', 'Product moved to cart');
    }
}
