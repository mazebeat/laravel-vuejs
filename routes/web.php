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

//

Route::get('vue', function () {
	return View::make('vue');
})->name('vue');

Route::resource('users', 'UsersController');

Route::get('test', function () {
	dd(\Illuminate\Support\Facades\Config::get('broadcasting'));
	dd(App\User::all());
});

//

Route::get('/chat', function () {
	return view('chat');
})->middleware('auth');

Route::get('/messages', function () {
	return App\Message::with('user')->get();
})->middleware('auth');

Route::post('/messages', function () {
	// Store the new message
	$user = Auth::user();
	
	$message = $user->messages()->create([
		'message' => request()->get('message')
	]);
	
	// Announce that a new message has been posted
	broadcast(new App\Events\MessagePosted($message, $user))->toOthers();

//	event(new App\Events\MessagePosted($message, $user));
	
	return ['status' => 'OK'];
})->middleware('auth');