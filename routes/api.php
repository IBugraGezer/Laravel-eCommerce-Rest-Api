<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/categories', [CategoryController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('brands', BrandController::class);
Route::apiResource('products', ProductController::class);

Route::group(['middleware' => 'auth:sanctum'], function() {


    Route::apiResource('addresses', AddressController::class);
    Route::post('/user/logout', [AuthController::class, 'logout']);
});
Route::any('/test', [\App\Http\Controllers\FileTestController::class, 'test'])->name('test');