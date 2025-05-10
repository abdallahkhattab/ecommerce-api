<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\FavoriteResource;

class FavoriteController extends Controller
{
    // Add product to favorites
    public function addToFavorites($productId)
    {
        $user = JWTAuth::user();
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Attach product to user's favorites (if not already favorited)
        if (!$user->favorites()->where('product_id', $productId)->exists()) {
            $user->favorites()->attach($productId);
        }

        return response()->json([
            'code'=>200,
            'data'=>[
                'message' => 'Product added to favorites',
                'product' => new FavoriteResource($product),
    
            ]
        ], 200);
    }

    // Remove product from favorites
    public function removeFromFavorites($productId)
    {
        $user = JWTAuth::user();

        // Detach product from favorites
        $user->favorites()->detach($productId);

        return response()->json([
            'code'=>200,
            'message' => 'Product removed from favorites'], 200);
    }

    // Get all favorite products
    public function getFavorites()
    {
        $user = JWTAuth::user();

         // Get the actual products, not just pivot data
         $favorites = $user->favorites()->get();

        if($favorites->isEmpty()){
            return response()->json(['message' => 'No favorites found'], 404);
        }
        
        return response()->json([
            'code'=>200,
            'data'=>[
            'favorites' => FavoriteResource::collection($favorites),
            ],
        ], 200);
    }
}
