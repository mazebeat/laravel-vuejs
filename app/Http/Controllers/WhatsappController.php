<?php

namespace App\Http\Controllers;

use App\Events\WhatsappEventListener;
use Lucasvdh\LaravelWhatsapp\Facades\Whatsapp;

class WhatsappController extends Controller
{
	protected $phoneNumber;
	protected $nickname;
	protected $password;
	
	function __construct($phoneNumber, $nickname, $password)
	{
		$this->phoneNumber = $phoneNumber; // Your phone number including country code
		$this->nickname  = $nickname; // This is the name that other Whatsapp users will see
		$this->password    = $password; // The password you received from the registration process
	}
	
	public function getConnection()
	{
		// Fetch the connection
		$connection = Whatsapp::getConnection($this->phoneNumber, $this->nickname);

		// Initialize your listener
		$listener = new WhatsappEventListener($connection);
		
		// Connect to the network
		$connection = Whatsapp::connect($connection, $this->password, $listener);
		
		
	}
	
	public function sendMessage($connection)
	{
		$target  = '3112345678'; // The phone number of the person you are sending the message to
		$message = 'This is a message';
		
		$message_hash = $connection->sendMessage($target, $message);
	}
}
