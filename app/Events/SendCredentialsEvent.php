<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendCredentialsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $carnet;
    public $correo;
    public $pin;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Object $user, $pin)
    {
        $this->carnet = $user->carnet;
        $this->correo = trim(strtolower($user->correo));
        $this->pin = $pin;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
