<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NewUser implements ShouldBroadcast
{
	use Dispatchable, InteractsWithSockets, SerializesModels;
	
	/**
	 *
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
	public function __construct(User $user)
	{
		$this->user = $user;
	}
	
	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return Channel|array
	 */
	public function broadcastOn()
	{
		Log::info('Event NewUser: newuser.' . $this->user->id);
		
		return new PrivateChannel('newuser.' . $this->user->id);
	}
}
