<?php

namespace App\Http\Controllers;

use App\Events\NewUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
	public function index()
	{
		$users = User::all();
		
		Log::info('Load users');
		
		return response()->json([
			'message' => 'Users loaded successfully',
			'users'   => $users
		]);
	}
	
	public function show($id)
	{
		$user = User::find($id);
		
		Log::info('Load user ' . $id);
		
		return response()->json([
			'user'    => $user,
			'message' => "User $id found successfully"
		]);
	}
	
	public function store(Request $request)
	{
		$this->validate($request, User::$rules);
		$user = User::create([
			'name'     => $request->input('name'),
			'email'    => $request->input('email'),
			'password' => bcrypt('password'),
		]);
		
		Log::info('Store user ' . $user->id);
		
//		broadcast(new NewUser($user))->toOthers();
		event(new NewUser($user));
		
		return response()->json([
			'message' => "User $user->id created successfully",
			'user'    => $user
		]);
	}
	
	public function update(Request $request, $id)
	{
		$this->validate($request, User::$rules);
		$user = User::find($id);
		$user->update($request->all());
		
		Log::info('Update user ' . $user->id);
		
		return response()->json([
			'message' => "User $id updated successfully"
		]);
	}
	
	public function destroy($id)
	{
		User::destroy($id);
		
		Log::info('Destroy user ' . $id);
		
		return response()->json([
			'message' => "User $id destroyed successfully"
		]);
	}
}