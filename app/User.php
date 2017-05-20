<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;
	
	public static $rules = [
		'name'  => 'required',
		'email' => 'required|email',
	];
	
	public static $messages = [
		'name.required'  => '',
		'email.required' => '',
	];
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	
	public function messages()
	{
		return $this->hasMany(Message::class);
	}
	
	public function chatMessages()
	{
		return $this->hasMany(ChatMessage::class);
	}
	
	public function hasAnyRole($roles): bool
	{
		if (is_array($roles)) :
			foreach ($roles as $role) :
				if ($this->hasRole($role)) :
					return true;
				endif;
			endforeach;
		endif;
		
		return false;
	}
	
	public function hasRole($role): bool
	{
		if ($this->roles()->where('name', $role)->first()) :
			return true;
		endif;
		
		return false;
	}
	
	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}
}
