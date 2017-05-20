<?php

namespace App\Events;

use App\ChatMessage;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessagePosted implements ShouldBroadcast
{
	use Dispatchable, InteractsWithSockets, SerializesModels;
	
	/**
	 * ChatMessage
	 *
	 * @var Message
	 */
	public $message;
	
	/**
	 * User
	 *
	 * @var User
	 */
	public $user;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(ChatMessage $message, User $user)
	{
		$this->message = $message;
		$this->user    = $user;
	}
	
	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return Channel|array
	 */
	public function broadcastOn()
	{
		return new PresenceChannel('chatroom');
	}
}
