<?php

namespace App;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
	use Notifiable;
	
	public static $rules = [
		'name'  => 'required',
		'email' => 'required|email',
	];
	
	public static $messages = [
		'name.required'      => '',
		'email.required'     => '',
		'job_title.required' => ''
	];
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'job_title'
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
	
	/**
	 * Customize method for Admin from current notification
	 *
	 * @link Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification
	 * @param string $token
	 * @overwrite method
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new AdminResetPasswordNotification($token));
	}
}
