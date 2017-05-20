<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
	Route::get('login', 'Auth\AdminLoginController@index')->name('admin.login');
	Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
});

Route::get('vue', function () {
	return View::make('vue');
})->name('vue');

Route::prefix('chat')->group(function () {
	Route::get('/', 'ChatsController@index');
	Route::get('messages', 'ChatsController@show');
	Route::post('messages', 'ChatsController@store');
});

Route::resource('users', 'UsersController');
Route::resource('messages', 'MessagesController');