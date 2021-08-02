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
    Route::get('/client', 'ClientController@show')->name('client.show');
});
