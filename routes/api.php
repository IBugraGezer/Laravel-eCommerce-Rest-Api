<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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

Route::get('/categories', [CategoryController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function() {

    Route::group(['middleware' => 'admin_check'], function() {
        Route::post('/categories', [CategoryController::class, 'store']);
    });
    Route::get('/test', [AuthController::class, 'test'])->name('test');
    Route::post('/logout', [AuthController::class, 'logout']);
});
