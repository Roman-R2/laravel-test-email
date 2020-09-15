<?php

namespace App\Mail;

use App\Entity\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageMail extends Mailable
{
    use Queueable, SerializesModels;

    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function build()
    {

        return $this->
        to(env('MAIL_TO'))->
        subject('You have a new message!')->
        view('email.message')->
        with([
            'text' => $this->message->message,
        ]);
    }
}
