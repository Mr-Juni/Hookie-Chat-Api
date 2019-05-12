<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Redis;

class MessageSent extends Event implements ShouldBroadcast
{
    public  $message;
    public  $user;
    private $to;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $user, $to = null)
    {
        $this->message  =  $message;
        $this->user     =  $user;
        $this->to       =  $to;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
         return new Channel('message-channel');
    }
}
