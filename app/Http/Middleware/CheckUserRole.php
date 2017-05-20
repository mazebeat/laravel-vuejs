<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRole
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($request->user() === null):
			return response('Insufficient permissions', 401);
		endif;
		$actions = $request->route()->getAction();
		$roles   = (array_has($actions, 'roles')) ? array_get($actions, 'roles') : null;
		if ($request->user()->hasAnyRole($roles) OR !$roles) :
			return $next($request);
		endif;
		
		return response('Insufficient permissions', 401);
	}
}
