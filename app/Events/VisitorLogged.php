<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class VisitorLogged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $visitor;
    public function __construct($visitor)
    {
        $this->visitor = $visitor;
    }
    public function broadcastOn()
    {
        return ['visitor-channel'];
    }
    public function broadcastAs()
    {
        return 'visitor-map-update';
    }
}
