<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;
    public $valid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($valid)
    {
        $this->valid = $valid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nueva consulta')->view('emails.contact-form');
    }
}
