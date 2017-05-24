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
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('admin')->group(function () {
	/**
	 * Basic routes by Admin
	 */
	Route::get('login', 'Auth\AdminLoginController@index')->name('admin.login');
	Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
	/**
	 * Password recovery by Admin
	 */
	Route::get('password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::post('password/reset', 'Auth\AdminResetPasswordController@reset');
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