<?php

namespace App\Http\Controllers;

use App\Message;
use App\Notifications\TaskCompleted;
use App\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
	}
	
	public function index()
	{
		$users = User::where('id', '!=', auth()->id())->get();
		
		return view('messages', compact('users'));
	}
	
	public function store(Request $request)
	{
		$message = Message::create([
			'message'    => $request->input('message'),
			'user_id'    => (int)auth()->id(),
			'to_user_id' => (int)$request->input('to_user')
		]);
		$task    = [
			'id'          => (int)auth()->id(),
			'title'       => 'New message incomming!',
			'description' => $message->message,
		];
		
		$message->notify(new TaskCompleted($task));
		
		return back()->with('flash', 'Message sent successfuly');
	}
}
