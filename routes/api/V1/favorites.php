<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Product\FavoriteController;

Route::middleware(['auth:api'])->group(function () {
    Route::post('favorites/{productId}', [FavoriteController::class, 'addToFavorites']);
    Route::delete('favorites/{productId}', [FavoriteController::class, 'removeFromFavorites']);
    Route::get('favorites', [FavoriteController::class, 'getFavorites']);
});
