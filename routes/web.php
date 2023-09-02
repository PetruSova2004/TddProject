<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', 'App\Http\Controllers\Web\Pub\IndexController@index')->name('home');

Route::get('/test', 'App\Http\Controllers\Web\Pub\IndexController@test')->name('test');
Route::get('/test2', 'App\Http\Controllers\Web\Pub\IndexController@test2')->name('test2');

Route::get('/payment', 'App\Http\Controllers\PaymentController@index');
Route::post('/charge', 'App\Http\Controllers\PaymentController@charge');
Route::get('/paymentsuccess', 'App\Http\Controllers\PaymentController@payment_success');
Route::get('/paymenterror', 'App\Http\Controllers\PaymentController@payment_error');


Route::get('/products', 'App\Http\Controllers\Web\Pub\ProductController@index')->name('products.index');
Route::get('/product', 'App\Http\Controllers\Web\Pub\ProductController@showProduct')->name('product.show');

Route::get('/about', 'App\Http\Controllers\Web\Pub\AboutController@index')->name('about.index');
Route::get('/contact', 'App\Http\Controllers\Web\Pub\ContactController@index')->name('contact.index');

Route::get('/blog', 'App\Http\Controllers\Web\Pub\BlogController@blog')->name('blog.index');
Route::get('/blogDetails', 'App\Http\Controllers\Web\Pub\BlogController@blogDetails')->name('blogDetails.index');


Route::get('/wishlist', 'App\Http\Controllers\Web\Pub\WishlistController@index')->name('wishlist.index');

Route::get('/compare', 'App\Http\Controllers\Web\Pub\CompareController@index')->name('compare.index');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', 'App\Http\Controllers\Web\Pub\AuthController@login')->name('login.index');
    Route::get('/register', 'App\Http\Controllers\Web\Pub\AuthController@register')->name('register.index');
    Route::get('/google/redirect', 'App\Http\Controllers\Web\Pub\AuthController@redirectToGoogle')->name('google.redirect');
    Route::get('/googleCallback', 'App\Http\Controllers\Web\Pub\AuthController@handleCallback')->name('google.callback');
});


Route::group(['middleware' => 'custom_web_auth'], function () {
    Route::get('/cart', 'App\Http\Controllers\Web\Pub\CartController@index')->name('cart.index');
    Route::get('/checkout', 'App\Http\Controllers\Web\Pub\CheckoutController@index')->name('checkout.index');
    Route::get('/account', 'App\Http\Controllers\Web\Pub\UserController@index')->name('user.index');

    Route::get('/successPayment', 'App\Http\Controllers\Web\Pub\AfterPaymentController@success')->name('success-payment.index');
    Route::get('/errorPayment', 'App\Http\Controllers\Web\Pub\AfterPaymentController@error')->name('error-payment.index');
});


