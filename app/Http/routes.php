<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group([ 'middleware'=>['web']], function () {
    Route::get('/', 'HomeController@index');
    Route::get('login','Auth\AuthController@getLogin');
    Route::post('login','Auth\AuthController@postLogin');
    Route::get('logout','Auth\AuthController@logout');

    Route::get('social/{type}', 'SocialAuthController@socialLogin');
    Route::get('redirect/{type}', 'SocialAuthController@redirect');

    Route::group(['prefix'=>''],function(){
        Route::resource('user', 'UserController');
    });

    Route::group(['prefix'=>''],function(){
        Route::resource('dashboard', 'DashboardController');
    });

    Route::group(['prefix'=>'api'],function(){
        Route::resource('google', 'GoogleApiController');
    });

});
