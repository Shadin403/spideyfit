<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    public function store(Request $request)
    {

        if ('rating' == null) {
            return Redirect::back()->with('error', 'Please select a rating');
        }

        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'rating' => 'required|integer|min:1|max:5',
                'review' => 'required|string|max:1000',
            ]);

            if (!Auth::check()) {
                // return response()->json(['error' => 'You must be logged in to submit a review'], 403);

                return redirect()->route('login')->with('error', 'Please login first');
            }

            $review =  Review::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
                'rating' => $request->rating,
                'review' => $request->review,
            ]);

            return Redirect::back()->with('success', 'Thank you for your review!');
        } catch (Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
}
