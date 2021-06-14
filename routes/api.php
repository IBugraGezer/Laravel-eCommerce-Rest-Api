<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\FileController;
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
Route::group(['middleware' => 'admin_check', 'prefix' => 'file-manager'], function() {
    Route::get('/get-public-storage-dir', [FileController::class, 'getPublicStorageDir'])->name('getPublicStorageDir');
    Route::post('/get-any-dir-under-public-storage', [FileController::class, 'getAnyDirUnderPublicStorage'])->name('getAnyDirUnderPublicStorage');
    Route::post('/download-file-from-public-storage', [FileController::class, 'downloadFileFromPublicStorage'])->name('downloadFileFromPublicStorage');
    Route::post('/upload-file-to-public-storage', [FileController::class, 'uploadFileToPublicStorage'])->name('uploadFileToPublicStorage');

});
