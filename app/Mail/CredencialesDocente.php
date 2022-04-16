<?php

namespace App\Mail;

use App\Models\Docente;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CredencialesDocente extends Mailable
{
    use Queueable, SerializesModels;

    public $docente;
    public $pin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Docente $docente, $pin)
    {
        //
        $this->docente = $docente;
        $this->pin = $pin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.CredencialesDocente');
    }
}
