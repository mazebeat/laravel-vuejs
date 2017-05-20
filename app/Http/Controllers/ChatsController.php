<?php

namespace App\Http\Controllers;

use App\ChatMessage;
use App\Events\ChatMessagePosted;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
	}
	
	public function index()
	{
		return view('chat');
	}
	
	public function show()
	{
		return ChatMessage::with('user')->get();
	}
	
	public function store()
	{
		$user    = Auth::user();
		$message = $user->chatMessages()->create([
			'message' => request()->get('message')
		]);
		broadcast(new ChatMessagePosted($message, $user))->toOthers();
		
		return ['status' => 'OK'];
	}
}