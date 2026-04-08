<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
class GeneralNotificationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $notification;
    public function __construct($notification)
    {
        $this->notification = $notification;
    }
    public function broadcastOn()
    {
        return new Channel('admin-notification');
    }
    public function broadcastAs()
    {
        return 'general.notification';
    }
    public function broadcastWith()
    {
        return [
            'notification' => $this->notification
        ];
    }

}
