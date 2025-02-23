<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Order\OrdersController;

Route::middleware(['auth:api'])->group(function () {
    Route::get('orders/me', [OrdersController::class, 'index']);
    Route::post('orders', [OrdersController::class, 'store']);
    Route::get('orders/{id}', [OrdersController::class, 'show']);
});
