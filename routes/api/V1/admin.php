<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Order\OrdersController;
use App\Http\Controllers\Api\V1\Brand\BrandsController;
use App\Http\Controllers\Api\V1\Category\CategoriesController;

Route::middleware(['auth:api', 'role:admin,editor,seller'])->group(function () {
    Route::apiResource('brands', BrandsController::class);
    Route::apiResource('categories', CategoriesController::class);
});

Route::middleware(['auth:api', 'role:admin,seller,super-admin'])->group(function () {
    Route::get('orders', [OrdersController::class, 'index'])->name('orders.adminIndex');
    Route::put('orders/{id}', [OrdersController::class, 'update'])->name('orders.update');
    Route::delete('orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
});
