<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailResetPassword extends Mailable
{
    use Queueable, SerializesModels;
public $User;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($User)
    {
        $this->User=$User;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.email_reset_password')->with([
            'user'=>$this->User
        ]);
    }
}
