<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
         * Admin : Can see all products, regardless of availability or ownership.
        *  Seller : Can only see and manage their own products.
        *  Regular User : Can only see products where is_available = true.
        * 
        */
    public function index(Request $request)
    {

        
        // Get the authenticated user
        $user = Auth::user();

        // Define a base query
        $query = Product::with(['brand', 'category']); // Eager-load relationships

        // Apply role-based filters
        if ($user && !$user->hasRole('admin')) {
            if ($user->hasRole('seller')) {
                // Sellers can only see their own products
                $query = $query->where('user_id', $user->id);
            } else {
                // Non-sellers (users without roles) can only see available products
                $query = $query->where('is_available', true);
            }
        }

        // Apply price range filter (if provided)
        if ($request->filled('priceFrom')) {
            $query = $query->where('price', '>=', $request->input('priceFrom'));
        }

        if ($request->filled('priceTo')) {
            $query = $query->where('price', '<=', $request->input('priceTo'));
        }

        // Apply sorting (default to ascending order by price)
        $sortOrder = $request->input('sort', 'asc'); // Default to 'asc'
        if (in_array($sortOrder, ['asc', 'desc'])) {
            $query = $query->orderBy('price', $sortOrder);
        } else {
            $query = $query->orderBy('price', 'asc'); // Fallback to ascending order
        }

        // Paginate the results
        $products = $query->paginate(10);

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }

        return ProductResource::collection($products); // Return formatted collection
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            // Create the product with the authenticated user's ID
            $productData = $request->validated();
            $productData['user_id'] = Auth::id(); // Set the user_id to the authenticated user

            $product = Product::create($productData);

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                $product->image = $this->uploadImage($request->file('image'));
                $product->save(); // Save the updated image path
            }

            return response()->json([
                'message' => 'Product created successfully',
                'product' => new ProductResource($product),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Ensure the user can view the product based on their role
        $user = Auth::user();

        if ($user && !$user->hasRole('admin')) {
            if ($user->hasRole('seller') && $product->user_id !== $user->id) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            if (!$user->hasRole('seller') && !$product->is_available) {
                return response()->json(['message' => 'Product not available'], 403);
            }
        }

        return new ProductResource($product); // Return formatted resource
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            // Ensure the seller can only update their own products
            $user = Auth::user();

            if ($user && !$user->hasRole('admin') && $product->user_id !== $user->id) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            // Update the product
            $product->update($request->validated());

            // Handle image update if provided
            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::delete('public/products/' . $product->image); // Delete old image
                }
                $product->image = $this->uploadImage($request->file('image'));
                $product->save(); // Save the updated image path
            }

            return response()->json([
                'message' => 'Product updated successfully',
                'product' => new ProductResource($product),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            // Ensure the seller can only delete their own products
            $user = Auth::user();

            if ($user && !$user->hasRole('admin') && $product->user_id !== $user->id) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            // Delete the associated image (if any)
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }

            // Soft delete the product
            $product->delete();

            return response()->json(['message' => 'Product deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * List all soft-deleted products for the seller.
     */
    public function deletedProduct()
    {
        $user = Auth::user();

        // Only sellers can view their soft-deleted products
        if ($user && !$user->hasRole('seller')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $products = Product::onlyTrashed()
            ->where('user_id', $user->id)
            ->get();

        return response()->json([
            'message' => 'Deleted products retrieved successfully',
            'products' => ProductResource::collection($products),
        ], 200);
    }

    /**
     * Permanently delete a soft-deleted product.
     */
    public function forcDelete(Product $product)
    {
        $user = Auth::user();

        // Only sellers can permanently delete their own products
        if ($user && !$user->hasRole('seller') || $product->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $product->forceDelete();

        return response()->json(['message' => 'Product permanently deleted'], 200);
    }

    /**
     * Restore a soft-deleted product.
     */
    public function restoreProduct(Product $product)
    {
        $user = Auth::user();

        // Only sellers can restore their own products
        if ($user && !$user->hasRole('seller') || $product->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $product->restore();

        return response()->json(['message' => 'Product restored successfully'], 200);
    }

    /**
     * Upload an image and return its path.
     */
    protected function uploadImage($file)
    {
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/products', $imageName);

        return 'products/' . $imageName; // Return relative path for database storage
    }
}