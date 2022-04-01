<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Promotor;

class CredencialesPromotor extends Mailable
{
    use Queueable, SerializesModels;

    public $promotor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Promotor $promotor)
    {
        //
        $this->promotor = $promotor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.CredencialesPromotor');
    }
}
