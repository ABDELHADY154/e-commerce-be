<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/clientLogin', 'ClientController@login')->name('client.login');
Route::post('/clientRegister', 'ClientController@register')->name('client.register');
Route::post('/resetPass', 'ForgetPasswordController@forgot')->name('client.forgetPassword');
Route::post('/resetVerify', 'ForgetPasswordController@verify')->name('client.verify');

Route::middleware('auth:api')->group(function () {
    Route::get('/clientProfile', 'ClientController@getProfile')->name('client.get-profile');
    Route::post('/clientUpdateImage', 'ClientController@updateImage')->name('client.update-image');
    Route::get('/men-brands', 'API\BrandController@getMenBrands')->name('get.men.brands');
    Route::get('/women-brands', 'API\BrandController@getWomenBrands')->name('get.women.brands');
    Route::get('/brand-categories/{brandId}', 'API\CategoryController@getCategories')->name('get.brand.categories');
    Route::get('/allProduct/{brandId}', 'API\ProductController@allProducts')->name('get.all.products.of.brand');
    Route::get('/categoryProducts/{catId}', 'API\ProductController@categoryProducts')->name('get.all.products.of.category');
    Route::post('/favorite', 'API\ProductController@favoriteProduct')->name('favorite.product');
    Route::post('/unfavorite', 'API\ProductController@unFavoriteProduct')->name('unfavorite.product');
    Route::get('/favorite', 'API\ProductController@getFavoritedProducts')->name('get.favorite.product');
    Route::get('/product/{id}', 'API\ProductController@getProduct')->name('get.product');
    Route::get('/newproduct', 'API\ProductController@getLatestNewProducts')->name('get.latest.new.products');
    Route::get('/saleproduct', 'API\ProductController@getLatestSaleProducts')->name('get.latest.sale.products');
    Route::post('/addtocart', 'API\CartController@addToCart')->name('add.to.cart');
    Route::get('/cart', 'API\CartController@cartList')->name('cart.list');
    Route::post('/updateCart', 'API\CartController@updateCart')->name('update.to.cart');
    Route::post('/deleteItem', 'API\CartController@deleteCartItem')->name('delete.to.cart');
    Route::apiResource('/clientAddress', 'API\ClientAddressController');
    Route::get('/defaultAddress', 'API\ClientAddressController@getDefaultAddress')->name('default.address');
    Route::post('/checkoutorder', 'API\OrderController@checkout')->name('checkout.order');
    Route::get('/order/{id}', 'API\OrderController@getOrder')->name('get.order');
    Route::get('/statusordered', 'API\OrderController@getOrderedStatus')->name('get.ordered.status');
    Route::get('/statusProcessed', 'API\OrderController@getProcessStatus')->name('get.processed.status');
    Route::get('/statusdelivered', 'API\OrderController@getDeliveredStatus')->name('get.delivered.status');
    Route::get('/ads', 'AdController@getAllImages')->name('get.all.ads');
    Route::put('/updateclientdata', 'ClientController@updateClientData')->name('update.client.data');
    Route::put('/changePassword', 'ClientController@changePass')->name('change.password.client');
});
