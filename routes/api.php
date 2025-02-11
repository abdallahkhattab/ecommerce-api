<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Brand\BrandsController;
use App\Http\Controllers\Api\V1\Category\CategoriesController;
use App\Http\Controllers\Api\V1\Location\LocationsController;
use App\Http\Controllers\Api\V1\Product\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public Routes (No Authentication Required)
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('products', [ProductsController::class, 'index']); // Public access to product listing
Route::get('products/{id}', [ProductsController::class, 'show']); // Public access to view a single product

// Protected User Routes
Route::middleware('auth:api')->group(function () {
    Route::get('user-profile', [AuthController::class, 'getAuthenticatedUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    
    // Locations are protected (only authenticated users can manage them)
    Route::apiResource('locations', LocationsController::class);
});

// Protected Admin/Editor/Seller Routes
Route::middleware(['auth:api', 'role:admin,editor,seller'])->group(function () {
    Route::apiResource('brands', BrandsController::class);
    Route::apiResource('categories', CategoriesController::class);
    
    // Product management is restricted, except for index & show
    Route::post('products', [ProductsController::class, 'store']); // Create product
    Route::put('products/{id}', [ProductsController::class, 'update']); // Update product
    Route::delete('products/{id}', [ProductsController::class, 'destroy']); // Delete product

    // Soft delete & restore actions
    Route::get('products/{id}/deleted', [ProductsController::class, 'deletedProduct']);
    Route::get('products/{id}/restore', [ProductsController::class, 'restoreProduct']);
    Route::delete('products/{id}/force', [ProductsController::class, 'forceDelete']);
});
