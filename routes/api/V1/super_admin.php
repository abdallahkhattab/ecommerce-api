<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AssignRole\SuperAdminController;

Route::middleware(['auth:api', 'role:super-admin'])->prefix('super-admin/users')->group(function () {
    Route::get('/', [SuperAdminController::class, 'index']);
    Route::post('/', [SuperAdminController::class, 'store']);
    Route::get('/{id}', [SuperAdminController::class, 'show']);
    Route::put('/{id}', [SuperAdminController::class, 'update']);
    Route::delete('/{id}', [SuperAdminController::class, 'destroy']);
});
