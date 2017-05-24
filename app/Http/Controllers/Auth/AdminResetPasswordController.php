<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;

class AdminResetPasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/
	
	use ResetsPasswords;
	
	/**
	 * Where to redirect users after resetting their password.
	 *
	 * @var string
	 */
	protected $redirectTo = '/admin';
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest:admin');
	}
	
	/**
	 * Display the password reset view for the given token.
	 *
	 * If no token is present, display the link request form.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  string|null              $token
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @overwrite method
	 */
	public function showResetForm(Request $request, $token = null)
	{
		return view('auth.passwords.admin-reset')->with(
			['token' => $token, 'email' => $request->email]
		);
	}
	
	/**
	 * Overwrite broker method
	 * Get information from auth configuration
	 *
	 * @return mixed
	 * @overwrite method
	 */
	protected function broker()
	{
		return Password::broker('admins');
	}
	
	/**
	 * Overwrite guard method
	 *
	 * @return mixed
	 */
	protected function guard()
	{
		return auth()->guard('admin');
	}
}
