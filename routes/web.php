<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes(['register' => false]);



Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/user', 'UserController');
    Route::resource('/client', 'ClientController');
    Route::resource('/gender', 'GenderController');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
