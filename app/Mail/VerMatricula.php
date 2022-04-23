<?php

namespace App\Mail;

use App\Models\Matricula;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerMatricula extends Mailable
{
    use Queueable, SerializesModels;

    public $matricula;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Matricula $matricula)
    {
        //
        $this->matricula = $matricula;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.VerMatricula');
    }
}
