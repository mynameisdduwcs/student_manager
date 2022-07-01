<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
//    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('adc11200@gmail.com','Student Manager')
            ->view('mails.mail-notify')
            ->subject('Notification Email');

    }
}
