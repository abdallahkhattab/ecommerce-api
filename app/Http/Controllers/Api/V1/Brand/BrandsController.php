<?php

namespace App\Http\Controllers\Api\V1\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Auth;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate();
    
        if ($brands->count() === 0) {
            return response()->json(['message' => 'No brands found'], 404);
        }
    
        $brandCollection = BrandResource::collection($brands);

        return response()->json([
        'code'=>200,
        'data' => $brandCollection,
        ], 200);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        try {
        $brand = Brand::create($request->validated());

            return response()->json([
                'message' => 'Brand created successfully',
                'brand' => new BrandResource($brand),
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create brand'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        // 1️⃣ $brand is already resolved via Route Model Binding
        /*
        If the brand is not found, Laravel automatically returns a 404 Not Found error.        
        */ 
       /* if (!$brand) {
            return response()->json(['message' => 'Brand not found'], 404);
        }*/

        return response()->json([
         
        'data'=> new BrandResource($brand)]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(BrandRequest $request, Brand $brand)
    {
        try {
            $data = $request->validated();
            $brand->update($data);
    
            return response()->json([
                'message' => 'Brand updated successfully',
                'brand' => new BrandResource($brand),
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
{
    try {
        // Attempt to delete the brand
        $brand->delete();
        // Return success response
        return response()->json(['message' => 'Brand deleted successfully'], 200);
    } catch (\Illuminate\Database\QueryException $e) {
        // Handle database-specific errors (e.g., foreign key constraints)
        return response()->json(['message' => 'Failed to delete brand due to database constraints'], 422);
    } catch (\Exception $e) {
        // Handle all other exceptions
        return response()->json(['message' => 'Failed to delete brand'], 500);
    }
}
}