<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Stripe\PaymentController;

Route::middleware(['auth:api'])->group(function () {
    Route::post('orders/{id}/pay', [PaymentController::class, 'pay']);
});
