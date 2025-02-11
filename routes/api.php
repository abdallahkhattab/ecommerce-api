<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Brand\BrandsController;
use App\Http\Controllers\Api\V1\Category\CategoriesController;
use App\Http\Controllers\Api\V1\location\LocationsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

//user
Route::middleware('auth:api')->group(function(){

    Route::get('user-profile',[AuthController::class,'getAuthenticatedUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::apiResource('location',LocationsController::class);
});

//admin-dashboard
Route::middleware(['auth:api', 'role:admin,editor'])->group(function () {
    Route::apiResource('brands',BrandsController::class);
    Route::apiResource('categories',CategoriesController::class);
    
});





