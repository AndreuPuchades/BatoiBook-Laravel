<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Messages\MailMessage;

class RegardsMail extends Notification
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Felicitaciones por tus Ventas')
            ->view('email.regards', ['user' => $this->user]);
    }
    public function build()
    {
        return $this->subject('Felicitaciones por tus Ventas')
            ->view('email.regards')
            ->with([
                'user' => $this->user,
            ]);
    }
}
