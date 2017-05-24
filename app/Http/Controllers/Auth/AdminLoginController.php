<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
	use Authenticatable;
	
	public function __construct()
	{
		$this->middleware('guest:admin')->except(['logout']);
	}
	
	/**
	 * Get the login username to be used by the controller.
	 * Overwrite this var by your 'username' var and change the login view as well
	 * @return string
	 */
	public function username()
	{
		return 'email';
	}
	
	public function index()
	{
		return view('auth.admin-login');
	}
	
	public function login(Request $request)
	{
		$this->validate($request, [
			'email'    => 'required|email',
			'password' => 'required'
		]);
		$credentials = [
			'email'    => $request->input('email'),
			'password' => $request->input('password')
		];
		if (auth()->guard('admin')->attempt($credentials, $request->input('remember'))) :
			return redirect()->intended(route('admin.dashboard'));
		endif;
		
		return redirect()->back()->withInput($request->except('password'));
	}
	
	public function logout()
	{
		auth()->guard('admin')->logout();
		
		return redirect('/admin');
	}
}
