<?php

namespace App\Http\Controllers\Api\V1\Review;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    // Store review for a product
    public function storeProductReview(Request $request, $id)
    {
        $request->validate([
            'body' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'user_id' => 'required|exists:users,id',
        ]);

        $product = Product::findOrFail($id);
        $review = $product->reviews()->create($request->all());

        return response()->json(['message' => 'Review added successfully', 'review' => $review], 201);
    }

 

    // Get all reviews for a product
    public function getProductReviews($id)
    {
        $product = Product::with('reviews')->findOrFail($id);
        return response()->json($product->reviews);
    }

  
}

