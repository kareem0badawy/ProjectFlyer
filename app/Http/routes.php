<?php
Route::get('/' , 'PagesController@home');



// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

	

Route::resource('flyers','FlyerController');

Route::get('{zip}/{street}','FlyerController@show');

Route::post('{zip}/{street}/photos' , ['as' => 'store_photo_path','uses' =>'FlyerController@addPhoto']);
