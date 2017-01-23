<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

get('signup','UsersController@create')->name('signup');
get('signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');

resource('users', 'UsersController');

post('login','SessionsController@store')->name('login');
get('login','SessionsController@create')->name('login');
delete('login','SessionsController@destroy')->name('logout');

get('password/email','Auth\PasswordController@getEmail')->name('password.reset');
post('password/email','Auth\PasswordController@postEmail')->name('password.reset');
get('password/reset/{token}','Auth\PasswordController@getReset')->name('password.edit');
post('password/reset', 'Auth\PasswordController@postReset')->name('password.update');

resource('statuses','StatusesController',['only'=>['store','destroy']]);

get('/users/{id}/followings', 'UsersController@followings')->name('users.followings');
get('/users/{id}/followers', 'UsersController@followers')->name('users.followers');

post('/users/followers/{id}', 'FollowersController@store')->name('followers.store');
delete('/users/followers/{id}', 'FollowersController@destroy')->name('followers.destroy');