<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ChatMessage extends Model
{
	// Import Notifiable Trait
	use Notifiable;
	
	protected $fillable = ['message'];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
}
