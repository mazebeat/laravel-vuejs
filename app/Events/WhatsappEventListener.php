<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Lucasvdh\LaravelWhatsapp\Abstracts\Listener as WhatsappListener;

/**
 * Check the Lucasvdh\LaravelWhatsapp\Interface\Listener for all events
 *
 * Class WhatsappEventListener
 * @package App\Events
 */
class WhatsappEventListener extends WhatsappListener
{
	use Dispatchable, InteractsWithSockets, SerializesModels;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}
	
	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return Channel|array
	 */
	public function broadcastOn()
	{
		return new PrivateChannel('channel-name');
	}
}
