<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAuthenticated
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @param  string|null              $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null)
	{
		switch ($guard):
			case 'admin':
				if (auth()->guard($guard)->check()) {
					return redirect()->route('admin.dashboard');
				}
				break;
			default:
				if (auth()->guard($guard)->check()) {
					return redirect('/home');
				}
				break;
		endswitch;
		
		return $next($request);
	}
}
