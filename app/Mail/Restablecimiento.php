<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Restablecimiento extends Mailable
{
    use Queueable, SerializesModels;

    public $carnet;
    public $pin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($carnet, $pin)
    {
        //
        $this->carnet = $carnet;
        $this->pin = $pin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.Restablecimiento');
    }
}
