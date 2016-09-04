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

Route::group(['middleware' => ['web']], function () {
	Route::get('/', function () {
		return view('home');
	});	
    
    Route::get('user/{slug}', 'userController@show');
	 
	Route::get('add/{token?}','userController@create');

	Route::post('add/{token?}','userController@store');
	
	Route::get('user/{slug}/edit/{token?}','userController@edit');
	
	Route::post('update/{token?}','userController@update'); 
	
	Route::get('delete/{id}/{token?}','userController@destroy');
	
	Route::get('query/{phone}', 'userController@searchQuery');
	
	Route::post('query', 'userController@searchShow');
	
	Route::post('paid', 'userController@paid');

	Route::post('contact','ContactController@store');


});
