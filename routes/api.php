<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Brand\BrandsController;
use App\Http\Controllers\Api\V1\Order\OrdersController;
use App\Http\Controllers\Api\V1\Product\FavoriteController;
use App\Http\Controllers\Api\V1\Product\ProductsController;
use App\Http\Controllers\Api\V1\Location\LocationsController;
use App\Http\Controllers\Api\V1\Category\CategoriesController;
use App\Http\Controllers\Api\V1\AssignRole\SuperAdminController;

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

Route::prefix('front')->group(function(){
    Route::get('products', [ProductsController::class, 'guestUserProducts']); // Public access to product listing
    Route::get('products/{product}', [ProductsController::class, 'show']); // Public access to view a single product
    
});

//super-admin Routes



// Protect routes with authentication middleware
Route::middleware(['auth:api','role:super-admin'])->prefix('super-admin/users')->group(function () {
    Route::get('/', [SuperAdminController::class, 'index']);         // List all users
    Route::post('/', [SuperAdminController::class, 'store']);        // Create a new user
    Route::get('/{id}', [SuperAdminController::class, 'show']);     // Get a specific user
    Route::put('/{id}', [SuperAdminController::class, 'update']);   // Update a user
    Route::delete('/{id}', [SuperAdminController::class, 'destroy']);// Delete a user
});

// Protected User Routes
Route::middleware('auth:api')->group(function () {
    Route::get('user-profile', [AuthController::class, 'getAuthenticatedUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
        
});

// Protected Admin/Editor/Seller Routes
Route::middleware(['auth:api', 'role:admin,editor,seller'])->group(function () {
    Route::apiResource('brands', BrandsController::class);
    Route::apiResource('categories', CategoriesController::class);
    
    // Product management is restricted, except for index & show
    Route::get('products', [ProductsController::class, 'index']); // Create product
    Route::post('products', [ProductsController::class, 'store']); // Create product
    Route::put('products/{product}', [ProductsController::class, 'update']); // Update product
    Route::delete('products/{product}', [ProductsController::class, 'destroy']); // Delete product

});

// Soft delete & restore actions
Route::middleware(['auth:api', 'role:admin,editor,seller'])->prefix('products')->group(function () {
    Route::get('deleted', [ProductsController::class, 'deletedProducts']);
    Route::patch('{id}/restore', [ProductsController::class, 'restoreProduct']);
    Route::delete('{id}/force', [ProductsController::class, 'forceDelete']);
});


//favorite product
Route::middleware(['auth:api'])->group(function () {
    Route::post('favorites/{productId}', [FavoriteController::class, 'addToFavorites']);
    Route::delete('favorites/{productId}', [FavoriteController::class, 'removeFromFavorites']);
    Route::get('favorites', [FavoriteController::class, 'getFavorites']);
});

// locations

Route::middleware('auth:api')->prefix('locations')->group(function () {
    Route::middleware('role:Admin')->group(function () {
        Route::get('/', [LocationsController::class, 'index']); // Admin only
        Route::get('/{location}', [LocationsController::class, 'show']); // Admin only
    });

    Route::post('/', [LocationsController::class, 'store']);
    Route::put('/{location}', [LocationsController::class, 'update']);
    Route::delete('/{location}', [LocationsController::class, 'destroy']);
    Route::get('/user/{userId}', [LocationsController::class, 'getUserLocations']);
});


Route::middleware(['auth:api'])->group(function () {
    // Users can view their own orders
    Route::get('orders/me', [OrdersController::class, 'index'])->name('orders.index');

    // Users can create orders
    Route::post('orders', [OrdersController::class, 'store'])->name('orders.store');

    // Users can view specific order details (only their own)
    Route::get('orders/{id}', [OrdersController::class, 'show'])->name('orders.show');

    // Users can view their specific order details
    Route::get('users/{user}/orders/{orderId}', [OrdersController::class, 'userOrderDetails'])->name('orders.userOrderDetails');
});

// Admin/Seller-specific routes
Route::middleware(['auth:api', 'role:admin,seller'])->group(function () {
    // Admins/sellers can view all orders
    Route::get('orders', [OrdersController::class, 'index'])->name('orders.adminIndex');

    // Admins/sellers can update or delete any order
    Route::put('orders/{id}', [OrdersController::class, 'update'])->name('orders.update');
    Route::delete('orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
});







