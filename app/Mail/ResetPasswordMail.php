<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $resetLink)
    {
      
        $this->resetLink = $resetLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $resetLink = url('/password/reset/' . $this->resetLink);

        return $this->subject('Password Reset Request')
            ->view('auth.email-body')
            ->with(['resetLink' => $this->resetLink]); // Pass the reset link
    }
}

?>
