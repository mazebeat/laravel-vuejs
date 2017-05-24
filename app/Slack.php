<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Slack extends Model
{
	use Notifiable;
	
	protected $guarded = ['id'];
	protected $fillable = ['from', 'channel', 'icon', 'image', 'message', 'attachment'];
}
