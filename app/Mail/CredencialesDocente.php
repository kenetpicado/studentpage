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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Docente $docente)
    {
        //
        $this->docente = $docente;
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
