<?php

namespace App\Http\Controllers;

use App\ChatMessage;
use App\Events\ChatMessagePosted;


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
		$chatMessages = ChatMessage::with('user')->get();
		
		return response()->json([
			'messages' => $chatMessages
		], 200);
	}
	
	public function store()
	{
		$user    = auth();
		$message = $user->chatMessages()->create([
			'message' => request()->input('message')
		]);
		broadcast(new ChatMessagePosted($message, $user))->toOthers();
		
		return response()->json([
			'message' => 'Chat message stored successfully'
		], 200);
	}
}