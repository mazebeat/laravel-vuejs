<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;

class Message extends Model
{
	// Import Notifiable Trait
	use Notifiable;
	
	protected $guarded = ['id'];
	protected $fillable = ['message', 'user_id', 'to_user_id'];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function routeNotificationForMail()
	{
		$user = User::find($this->to_user_id);
		
		return $user->email;
	}
	
	public function routeNotificationForSlack()
	{
		return Config::get('service.slack.token');
	}
}
