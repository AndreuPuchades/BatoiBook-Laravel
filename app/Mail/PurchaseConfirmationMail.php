<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $book;

    public function __construct($book)
    {
        $this->book = $book;
    }

    public function build()
    {
        return $this->subject('Compra Confirmada')
            ->view('email.sale')
            ->with([
                'book' => $this->book,
            ]);
    }
}
