<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false]);


Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/user', 'UserController');
    Route::resource('/client', 'ClientController');
    Route::resource('/gender', 'GenderController');
    Route::resource('/brand', 'BrandController')->except(['edit', 'update', 'show']);
    Route::resource('/category', 'CategoryController')->except(['edit', 'update', 'show']);
    Route::resource('/product', 'ProductController');
    Route::resource('/productSize', 'ProductSizeController');
    Route::resource('/clientAddress', 'ClientAddressController');
    Route::resource('/order', 'OrderController');
    Route::resource('/ad', 'AdController')->except(['show', 'edit', 'update']);
    Route::get('/processOrder/{id}', 'OrderController@processOrder')->name('process.order');
    Route::get('/wayorder/{id}', 'OrderController@wayorder')->name('way.order');
    Route::get('/deliveredorder/{id}', 'OrderController@deliverOrder')->name('deliver.order');
    Route::get('/processOrderIndex/{id}', 'OrderController@processOrderIndex')->name('process.order.index');
    Route::get('/wayorderIndex/{id}', 'OrderController@wayorderIndex')->name('way.order.index');
    Route::get('/deliveredorderIndex/{id}', 'OrderController@deliverOrderIndex')->name('deliver.order.index');
    Route::resource('/clientMessage', 'ClientMessageController')->except(['update', 'edit', 'show', 'store', 'create']);
});
