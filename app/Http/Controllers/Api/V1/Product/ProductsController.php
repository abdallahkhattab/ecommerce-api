<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['brand', 'category']); // Eager-load relationships

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
            // Create the product
            $product = Product::create($request->validated());

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
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return new ProductResource($product); // Return formatted resource
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
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
            // Delete the associated image (if any)
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }

            // Delete the product
            $product->delete();

            return response()->json(['message' => 'Product deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function deletedProduct(){
        $user = Auth::user();
        $products = Product::where('user_id',$user->id)->onlytrashed();
        $products = Product::onlyTrashed()->get();
        return response()->json(['message'=> 'deleted proudcts',$products],200);
    }

    public function forcDelete(Product $product){
        $user = Auth::user();
        $product->where('user_id',$user->id)->forceDelete();
        return response()->json(['message'=>'product deleted permanent'],200);
    }


    public function restoreProduct(Product $product){
        $user = Auth::user();
        $product->where('user_id',$user->id)->restore();
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