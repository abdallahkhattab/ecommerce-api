<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Location\LocationsController;

Route::middleware('auth:api')->prefix('locations')->group(function () {
    Route::middleware('role:Admin')->group(function () {
        Route::get('/', [LocationsController::class, 'index']);
        Route::get('/{location}', [LocationsController::class, 'show']);
    });

    Route::post('/', [LocationsController::class, 'store']);
    Route::put('/{location}', [LocationsController::class, 'update']);
    Route::delete('/{location}', [LocationsController::class, 'destroy']);
    Route::get('/user/{userId}', [LocationsController::class, 'getUserLocations']);
});
