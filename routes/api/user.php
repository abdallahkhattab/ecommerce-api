<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Order\OrdersController;

Route::middleware(['auth:api'])->group(function () {
    Route::get('orders/me', [OrdersController::class, 'index'])->name('orders.index');
    Route::post('orders', [OrdersController::class, 'store'])->name('orders.store');
    Route::get('orders/{id}', [OrdersController::class, 'show'])->name('orders.show');
    Route::get('users/{user}/orders/{orderId}', [OrdersController::class, 'userOrderDetails'])->name('orders.userOrderDetails');
});
