<?php

use App\Http\Controllers\Api\Admin\AuthAdminController;
use App\Http\Controllers\Api\Admin\CategoryAdminController;
use App\Http\Controllers\Api\Admin\HomeAdminController;
use App\Http\Controllers\Api\Admin\OrderAdminController;
use App\Http\Controllers\Api\Admin\ProductAdminController;
use App\Http\Controllers\Api\Admin\UserAdminController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\User\AuthUserController;
use App\Http\Controllers\Api\User\CartUserController;
use App\Http\Controllers\Api\User\CategoryUserController;
use App\Http\Controllers\Api\User\CouponeUserController;
use App\Http\Controllers\Api\User\FavoriteUserController;
use App\Http\Controllers\Api\User\OrderUserController;
use App\Http\Controllers\Api\User\PaymentUserController;
use App\Http\Controllers\Api\User\ProductUserController;
use App\Http\Controllers\Api\User\RateUserController;
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
        Route::post('forget-password', 'forgetPassword');
        Route::post('reset-password', 'resetPassword');
        Route::post('change-password', 'changePassword');
    });
    Route::group(['prefix' => 'categories', 'controller' => CategoryUserController::class], function () {
        Route::get('', 'index');
        Route::get('/{id}', 'show');
    });
    Route::group(['prefix' => 'products', 'controller' => ProductUserController::class], function () {
        Route::get('', 'index');
        Route::get('/show/{id}', 'show');
        Route::get('/filter-by-categoy/{id}', 'filter');
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
    Route::group(['prefix' => 'coupons', 'controller' => CouponeUserController::class], function () {
        Route::post('/add', 'add');
    });
    Route::group(['prefix' => 'ratings', 'controller' => RateUserController::class], function () {
        Route::post('/add/{product}', 'add');
        Route::post('/remove/{product}', 'remove');
    });
    Route::group(['prefix' => 'payments', 'controller' => PaymentUserController::class], function () {
        Route::get('', 'index');
    });
    Route::group(['prefix' => 'orders', 'controller' => OrderUserController::class], function () {
        Route::get('', 'index');
        Route::get('/show/{id}', 'show');
        Route::post('/add', 'add');
    });
});




Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'auth', 'controller' => AuthAdminController::class], function ($router) {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::get('profile', 'profile');
        Route::post('update-profile', 'updateProfile');
    });

    Route::group(['prefix' => 'home', 'controller' => HomeAdminController::class], function () {
        Route::get('', 'index');
    });

    Route::group(['prefix' => 'categories', 'controller' => CategoryAdminController::class], function () {
        Route::get('', 'index');
        Route::get('/{id}', 'show');
        Route::post('/add', 'add');
        Route::post('/update/{id}', 'update');
        Route::post('/remove/{id}', 'remove');
    });

    Route::group(['prefix' => 'products', 'controller' => ProductAdminController::class], function () {
        Route::get('', 'index');
        Route::get('/show/{id}', 'show');
        Route::get('/filter-by-category/{id}', 'filter');
        Route::post('/add', 'add');
        Route::post('/update/{id}', 'update');
        Route::post('/remove/{id}', 'remove');
    });

    Route::group(['prefix' => 'users', 'controller' => UserAdminController::class], function () {
        Route::get('', 'index');
        Route::get('/show/{id}', 'show');
    });

    Route::group(['prefix' => 'orders', 'controller' => OrderAdminController::class], function () {
        Route::get('', 'index');
        Route::get('/show/{id}', 'show');
    });
});


Route::get('settings', [SettingController::class, 'index']);
Route::get('status-order', [SettingController::class, 'statusOrder']);
