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

Route::post('/generateToken', 'App\Services\CustomToken\CustomTokenService@generate')->name('api.generateToken');
Route::post('/verifyToken', 'App\Services\CustomToken\CustomTokenService@verify')->name('api.verifyToken');

Route::patch('/confirmOrder/{orderId}', 'App\Http\Controllers\Api\Pub\Checkout\Services\PaymentService@approveOrder')->name('api.approveOrder');

Route::middleware('demand_token')->group(function () {
    Route::get('/categoryAll', 'App\Http\Controllers\Api\Pub\Category\CategoryController@getCategories')->name('api.getCategories');
    Route::get('/popularTags', 'App\Http\Controllers\Api\Pub\Tag\TagController@getMostPopularTags')->name('api.getPopularTags');
    Route::get('/getCookie/{cookieName}', 'App\Services\Cookie\CookieService@getCookie')->name('api.getCookie');
    Route::get('/getProducts', 'App\Http\Controllers\Api\Pub\Product\ProductController@getProducts')->name('api.getProducts');
    Route::get('/getProduct', 'App\Http\Controllers\Api\Pub\Product\ProductController@getProduct')->name('api.getProduct');

    Route::post('/login', 'App\Http\Controllers\Api\Pub\Auth\AuthApiController@login')->name('api.login');
    Route::post('/registration', 'App\Http\Controllers\Api\Pub\Auth\AuthApiController@register')->name('api.register');

    Route::get('/getProductReviews', 'App\Http\Controllers\Api\Pub\Review\ReviewController@getProductReviews')->name('api.getProductReviews');

    Route::get('/getWishlist', 'App\Http\Controllers\Api\Pub\Wishlist\WishlistController@get')->name('api.getWishlist');
    Route::post('/addToWishlist', 'App\Http\Controllers\Api\Pub\Wishlist\WishlistController@add')->name('api.addToWishlist');
    Route::delete('/clearWishlist', 'App\Http\Controllers\Api\Pub\Wishlist\WishlistController@clearAll')->name('api.clearWishlist');
    Route::delete('/deleteProductFromWishlist', 'App\Http\Controllers\Api\Pub\Wishlist\WishlistController@deleteOne')->name('api.deleteOneFromWishlist');

});


Route::middleware('auth:api')->group(function () {
    // Маршруты, требующие аутентификации с использованием токена

    Route::post('/deleteCookie/{cookieName}', 'App\Services\Cookie\CookieService@removeCookie')->name('api.getCookie');
    Route::post('/logout', 'App\Http\Controllers\Api\Pub\Auth\AuthApiController@logout')->name('api.logout');

    Route::get('/getCart', 'App\Http\Controllers\Api\Pub\Cart\CartController@cartGet')->name('api.getCart');
    Route::post('/cart/add', 'App\Http\Controllers\Api\Pub\Cart\CartController@cartAdd')->name('api.cartAdd');
    Route::post('/cart/delete', 'App\Http\Controllers\Api\Pub\Cart\CartController@cartDelete')->name('api.cartDelete');
    Route::post('/completeCart/delete', 'App\Http\Controllers\Api\Pub\Cart\CartController@cartDelete')->name('api.completeCartDelete');

    Route::get('/getUser', 'App\Http\Controllers\Api\Pub\User\UserApiController@getUserByToken')->name('api.getUser');
    Route::patch('/updateProfile', 'App\Http\Controllers\Api\Pub\User\UserApiController@updateProfile')->name('api.updateProfile');
    Route::get('/checkAdmin', 'App\Http\Controllers\Api\Pub\User\UserApiController@checkAdmin')->name('api.checkAdmin');

    Route::post('/applyCoupon', 'App\Http\Controllers\Api\Pub\Checkout\CouponController@apply')->name('api.applyCoupon');
    Route::delete('/deleteCoupon', 'App\Http\Controllers\Api\Pub\Checkout\CouponController@delete')->name('api.deleteCoupon');
    Route::get('/getCoupon', 'App\Services\Coupon\CouponService@getCoupon')->name('api.getCoupon');

    Route::get('/blogs', 'App\Http\Controllers\Api\Pub\Blog\BlogController@getBlogs')->name('api.getBlogs');
    Route::get('/blog', 'App\Http\Controllers\Api\Pub\Blog\BlogController@getBlogDetails')->name('api.getBlogDetails');

    Route::get('/getCountries', 'App\Services\Country\CountryService@getCountries')->name('api.getCountries');

    Route::get('/getOrder', 'App\Http\Controllers\Api\Pub\Checkout\CheckoutController@getOrder')->name('api.getOrder');
    Route::post('/placeOrder', 'App\Http\Controllers\Api\Pub\Checkout\CheckoutController@placeOrder')->name('api.placeOrder');

    Route::post('/payment', 'App\Http\Controllers\Api\Pub\Checkout\PaymentController@charge')->name('api.payOrder');
    Route::post('/errorPayment', 'App\Http\Controllers\Api\Pub\Checkout\PaymentController@payment_error')->name('api.paymentError');
    Route::post('/successPayment', 'App\Http\Controllers\Api\Pub\Checkout\PaymentController@payment_success')->name('api.paymentSuccess');

    Route::post('/applyReview', 'App\Http\Controllers\Api\Pub\Review\ReviewController@apply')->name('api.applyReview');
});


