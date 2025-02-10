<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10); // Paginate with 10 items per page
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            // Create the category
           // $data = $request->validated();
           // $data['slug'] = Str::slug($data['name']); // Generate the slug from the name
    
            $category = Category::create($request->validated());

            // Handle image upload if provided

            if ($request->hasFile('image')) {
                $imagePath = $this->uploadImage($request->file('image'));
                $category->update(['image' => $imagePath]); // Save the image path
            }

            // Return success response with the created category
            return response()->json([
                'message' => 'Category created successfully',
                'category' => new CategoryResource($category),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Route model binding ensures $category is already resolved
        return response()->json([
            'message' => 'Category retrieved successfully',
            'category' => new CategoryResource($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            // Update the category
            $category->update($request->validated());

            // Handle image update if provided
            if ($request->hasFile('image')) {
                $imagePath = $this->uploadImage($request->file('image'));
                $category->update(['image' => $imagePath]); // Save the updated image path
            }

            // Return success response with the updated category
            return response()->json([
                'message' => 'Category updated successfully',
                'category' => new CategoryResource($category),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Delete the category
            $category->delete();

            // Return success response
            return response()->json([
                'message' => 'Category deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Upload an image and return its path.
     */
    protected function uploadImage($file)
    {
        // Define the upload path
        $path = 'images/categories';

        // Generate a unique filename
        $filename = time() . '_' . $file->getClientOriginalName();

        // Move the uploaded file to the storage directory
        $file->storeAs($path, $filename);

        // Return the full path to the image
        return $path . '/' . $filename;
    }
}