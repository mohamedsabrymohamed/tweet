<?php

use Illuminate\Http\Request;

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
Route::group(['namespace' => 'API', 'middleware' => 'localization'], function () {
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('details', 'UserController@details');
        //tweets resources
        Route::post('tweets', 'TweetController@store');
        Route::delete('tweets/{id}', 'TweetController@destroy');
        //followers resources
        Route::post('follow', 'UserController@follow');
        Route::get('timeline/{id}', 'UserController@timeline');
    });
});
