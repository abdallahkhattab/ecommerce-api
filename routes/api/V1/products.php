<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Product\ProductsController;

Route::prefix('front')->group(function () {
    Route::get('products', [ProductsController::class, 'guestUserProducts']);
    Route::get('products/{product}', [ProductsController::class, 'show']);
});

Route::middleware(['auth:api', 'role:admin,editor,seller'])->group(function () {
    Route::get('products', [ProductsController::class, 'index']);
    Route::post('products', [ProductsController::class, 'store']);
    Route::put('products/{product}', [ProductsController::class, 'update']);
    Route::delete('products/{product}', [ProductsController::class, 'destroy']);
});

Route::middleware(['auth:api', 'role:admin,editor,seller'])->prefix('products')->group(function () {
    Route::get('deleted', [ProductsController::class, 'deletedProducts']);
    Route::patch('{id}/restore', [ProductsController::class, 'restoreProduct']);
    Route::delete('{id}/force', [ProductsController::class, 'forceDelete']);
});
