<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookAdmissionNotification extends Notification
{
    public $book;

    public function __construct($book)
    {
        $this->book = $book;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Un nuevo libro ha sido dado de alta.')
            ->action('Admitir Libro', route('book.admit', $this->book->id))
            ->line('Gracias por usar nuestra aplicación!')
            ->line('Revisa el libro aquí: ' . route('book.show', $this->book->id));
    }
}
