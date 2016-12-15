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


Route::get('about', function () {
    // return view('welcome');
    return 'this is abs';
});

Route::get('publish',function () {
    // return view('welcome');
    return view('publish');
} );


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

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
	Route::get('/', 'ItemController@get_item_list');
	Route::get('info', 'UserController@personal_info');
	Route::post('info', 'UserController@getinfo');
	Route::get('publish', 'ItemController@get_add_item');
	Route::post('publish', 'ItemController@post_add_item');
	Route::get('test_relation', 'ItemController@test');
	Route::get('test_relation2', 'UserController@test');
	Route::post('/home', 'ItemController@zan');
	Route::post('/comment', 'CommentController@post_comment');
	Route::post('/delete_comment', 'CommentController@delete_comment');
	
});
