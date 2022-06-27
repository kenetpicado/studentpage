<?php

namespace App\Listeners;

use App\Events\SendCredentialsEvent;
use App\Mail\Credenciales;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCredentialsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendCredentialsEvent $user)
    {
        Mail::to($user->correo)->send(new Credenciales($user));
    }
}
