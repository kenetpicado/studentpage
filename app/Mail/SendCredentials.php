<?php

namespace App\Mail;

use App\Models\Centro;
use App\Models\Docente;
use App\Models\Promotor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $promotor, $centro;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Promotor $promotor, Centro $centro)
    {
        //
        $this->promotor = $promotor;
        $this->centro = $centro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.promotor')
            ->subject('Credenciales Promotor');
    }
}
