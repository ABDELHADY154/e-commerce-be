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
});
