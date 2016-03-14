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

    Route::group(['prefix'=>'','middlerware'=>'auth'],function(){
      Route::resource('admin', 'AdminController');
    });

    Route::group(['prefix'=>'','middlerware'=>'auth'],function(){
      Route::get('addtutorial/{id}/delete','addTutorialController@destroy');
        Route::resource('addtutorial', 'addTutorialController');
    });

    Route::group(['prefix'=>'','middlerware'=>'auth'],function(){
        Route::get('addsubject/{id}/delete','AddSubjectController@destroy');
        Route::post('getsubjects','AddSubjectController@getsubjects');
        Route::resource('addsubject', 'AddSubjectController');
    });

    Route::group(['prefix'=>'','middlerware'=>'auth'],function(){
        Route::resource('dashboard', 'DashboardController');
    });

    Route::group(['prefix'=>'','middlerware'=>'authcheck'],function(){
        Route::get('download/{id}','TutorialController@download');
        Route::resource('tutorial', 'TutorialController');
    });


    Route::group(['prefix'=>''],function(){
        Route::get('topic/{id}/delete','TopicController@destroy');
        Route::post('gettopics','TopicController@getTopics');
        Route::resource('topic', 'TopicController');
    });


    Route::group(['prefix'=>''],function(){
        Route::resource('profile', 'ProfileController');
    });

    Route::group(['prefix'=>''],function(){
        Route::resource('user', 'UserController');
    });

});
