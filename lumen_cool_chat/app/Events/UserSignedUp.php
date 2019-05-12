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

class UserSignedUp extends Event implements ShouldBroadcast
{
    public $name;
    public $permission;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name, $permission)
    {
        $this->name = $name;
        $this->permission = $permission;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
         return new Channel('signup-channel');
    }
}
