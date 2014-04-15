<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/
Route::get('/', array('uses' => 'App\Controllers\HomeController@showWelcome'));
Route::get('welcome', array('uses' => 'App\Controllers\HomeController@showWelcome'));
Route::post('login', array('uses' => 'App\Controllers\HomeController@doLogin'));
Route::post('logout', array(
	'before' => 'auth', 
	'uses' => 'App\Controllers\HomeController@logout'
));
Route::group(array('before' => 'guest'), function(){
	Route::get('login', array('uses' => 'App\Controllers\HomeController@showLogin'));
	Route::get('signup', array('uses' => 'App\Controllers\HomeController@showSignup'));
});


/*
|--------------------------------------------------------------------------
| Resource Routes
|--------------------------------------------------------------------------
*/
Route::get('search', array('uses' => 'App\Controllers\FeedController@findFeeds'));
Route::get('profile', array('uses' => 'App\Controllers\UserController@edit'));
Route::get('user/{id}', function(){
	return Redirect::to('profile');
});
Route::resource('lists', 'App\Controllers\FeedlistController', array(
	'except' => array('edit', 'create')
));
Route::post('lists/{id}/pins', 'App\Controllers\FeedlistController@addPin');
Route::resource('user', 'App\Controllers\UserController', array(
	'only' => array('store', 'update')
));
Route::resource('pins', 'App\Controllers\PinController');


