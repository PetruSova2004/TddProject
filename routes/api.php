<?php

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

Route::post('/registration', 'App\Http\Controllers\Api\Pub\Auth\AuthApiController@register')->name('api.register');
Route::post('/login', 'App\Http\Controllers\Api\Pub\Auth\AuthApiController@login')->name('api.login');

Route::get('/getCookie/{cookieName}', 'App\Services\Cookie\CookieService@getCookie')->name('api.getCookie');
Route::get('/categoryAll', 'App\Http\Controllers\Api\Pub\Category\CategoryController@getCategories')->name('api.getCategories');
Route::get('/getProducts', 'App\Http\Controllers\Api\Pub\Product\ProductController@getProducts')->name('api.getProducts');
Route::get('/getProduct', 'App\Http\Controllers\Api\Pub\Product\ProductController@getProduct')->name('api.getProduct');



Route::middleware('auth:api')->group(function () {
    // Маршруты, требующие аутентификации с использованием токена

    Route::post('/deleteCookie/{cookieName}', 'App\Services\Cookie\CookieService@removeCookie')->name('api.getCookie');
    Route::post('/logout', 'App\Http\Controllers\Api\Pub\Auth\AuthApiController@logout')->name('api.logout');

    Route::get('/getCart', 'App\Http\Controllers\Api\Pub\Cart\CartController@cartGet')->name('api.getCart');
    Route::post('/cart/add', 'App\Http\Controllers\Api\Pub\Cart\CartController@cartAdd')->name('api.cartAdd');
    Route::post('/cart/delete', 'App\Http\Controllers\Api\Pub\Cart\CartController@cartDelete')->name('api.cartDelete');

    Route::get('/getUser', 'App\Http\Controllers\Api\Pub\User\UserApiController@getUserByToken')->name('api.getUser');

});
