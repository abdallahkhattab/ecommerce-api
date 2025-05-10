<?php

namespace App\Http\Controllers\Api\V1\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ShowCategoryResource;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $categories = Category::paginate(10); 
        return
        [
        'code'=>200,
          'data'=> [
            'categories'=>CategoryResource::collection($categories),
          ] 
        ]; 
       

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $user = JWTAuth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
    
        // Load roles and ensure it's a collection
        $user->loadMissing('roles');
    
        if (!optional($user->roles)->count()) {
            return response()->json(['message' => 'Forbidden – User has no roles'], 403);
        }
    
        try {
            $category = Category::create($request->validated());

            if ($request->hasFile('image')) {
                $imagePath = $this->handleImageUpload($request->file('image'));
                $category->update(['image' => $imagePath]);
            }

            return response()->json([
                'code'=>200,
                'message' => 'Category created successfully',
                'data'=>[
                    'category' => new CategoryResource($category),
                ],
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating category', 'error' => $e->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    
    {
        $category->load('products'); // Eager-load related products
        return response()->json([
            'code'=>200,
            'message' => 'Category retrieved successfully',
            'data'=>[
                'category' => new CategoryResource($category),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }

                $imagePath = $this->handleImageUpload($request->file('image'));
                $category->update(['image' => $imagePath]);
            }

            return response()->json([
                'code'=>200,
                'message' => 'Category updated successfully',
                'data'=>[
                'category' => new CategoryResource($category),
                ],
            ]);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating category', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Delete associated image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $category->delete();

            return response()->json([
            'code'=>200,
            'message' => 'Category deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting category', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Handle image upload and return file path.
     */
    protected function handleImageUpload($file)
    {
        return $file->store('images/categories', 'public');
    }
}
