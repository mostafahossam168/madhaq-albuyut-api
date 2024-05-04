<?php

use App\Http\Controllers\Api\User\AuthUserController;
use App\Http\Controllers\Api\User\CartUserController;
use App\Http\Controllers\Api\User\CategoryUserController;
use App\Http\Controllers\Api\User\FavoriteUserController;
use App\Http\Controllers\Api\User\OrderUserController;
use App\Http\Controllers\Api\User\ProductUserController;
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


Route::group(['prefix' => 'user'], function () {
    Route::group(['prefix' => 'auth', 'controller' => AuthUserController::class], function ($router) {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::get('profile', 'profile');
        Route::post('update-profile', 'updateProfile');
    });
    Route::group(['prefix' => 'categories', 'controller' => CategoryUserController::class], function () {
        Route::get('', 'index');
        Route::get('/{id}', 'show');
    });
    Route::group(['prefix' => 'products', 'controller' => ProductUserController::class], function () {
        Route::get('', 'index');
        Route::get('/show/{id}', 'show');
        Route::get('/filter/{id}', 'filter');
    });
    Route::group(['prefix' => 'orders', 'controller' => OrderUserController::class], function () {
        Route::get('', 'index');
        // Route::get('/show/{id}', 'show');
        // Route::get('/filter/{id}', 'filter');
    });
    Route::group(['prefix' => 'cart', 'controller' => CartUserController::class], function () {
        Route::get('', 'index');
        Route::post('/add/{id}', 'add');
        Route::post('/update/{id}', 'update');
        Route::post('/remove/{id}', 'remove');
    });
    Route::group(['prefix' => 'favorite', 'controller' => FavoriteUserController::class], function () {
        Route::get('', 'index');
        Route::post('/add/{id}', 'add');
        Route::post('/remove/{id}', 'remove');
    });
});