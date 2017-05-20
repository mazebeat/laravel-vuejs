<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

/**
 * Add cacert.pem file from https://curl.haxx.se/ca/cacert.pem in c:\xampp\php\cacert.pem
 * Change setting in php.ini file:
 * curl.cainfo = "C:\xampp\php\cacert.pem
 *
 * Class TaskCompleted
 * @package App\Notifications
 */
class TaskCompleted extends Notification implements ShouldQueue
{
	use Queueable;
	
	private $task;
	
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($task)
	{
		$this->task = $task;
	}
	
	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed $notifiable slack, nexmo, broadcast, mail and database
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail', 'slack'];
	}
	
	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		return (new MailMessage)
			->line('The introduction to the notification.')
			->action('Notification Action', url('/'))
			->line('Thank you for using our application!');
	}
	
	/**
	 * Get the Slack representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return \Illuminate\Notifications\Messages\SlackMessage
	 */
	public function toSlack($notifiable)
	{
		$task = $this->task;
		
		return (new SlackMessage)
			->from('Laravel')
			->success()
			->content("A task has been completed. " . $notifiable->message);
	}
	
	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return array
	 */
	public function toArray($notifiable)
	{
		return [
			'title'       => $this->task->title,
			'description' => $this->task->description
		];
	}
}
