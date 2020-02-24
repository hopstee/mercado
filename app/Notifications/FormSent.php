<?php
/**
 * LaraClassified - Classified Ads Web Application
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class FormSent extends Notification implements ShouldQueue
{
	use Queueable;
	
	protected $msg;
	protected $file;
	
	public function __construct($request)
	{
		$this->msg = $request;
		if(isset($this->msg->file)) {
			$this->file = ' <a href="' . $this->msg->file . '" download>Download</a>';
		} else {
			$this->file = 'None';
		}
	}
	
	public function via($notifiable)
	{
		return ['mail'];
	}
	
	public function toMail($notifiable)
	{	
		$mailMessage = (new MailMessage)
			->replyTo($this->msg->email, $this->msg->first_name)
			->subject(trans('mail.contact_form_title', ['country' => $this->msg->country_name, 'appName' => config('app.name')]))
			->line(t('Country') . ': <a href="' . lurl('/?d=' . $this->msg->country_code) . '">' . $this->msg->country_name . '</a>')
			->line(t('Name') . ': ' . $this->msg->first_name)
			->line(t('Phone') . ': ' . $this->msg->phone)
			->line(t('Email Address') . ': ' . $this->msg->email)
		    ->line(t('File') . ': ' . $this->file);
		
		if (isset($this->msg->company_name) && $this->msg->company_name!='') {
			$mailMessage->line(t('Company Name') . ': ' . $this->msg->company_name);
		}
		
		$mailMessage->line(nl2br($this->msg->message));
		
		return $mailMessage;
	}
}
