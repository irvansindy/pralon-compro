<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DownloadNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels ;
    public $message;
    public $countBrocure;
    public $countPricelist;
    public $type;
    /**
     * Create a new event instance.
     */
    public function __construct($type, $countBrocure, $countPricelist)
    {
        $this->type = $type;
        $this->countBrocure = $countBrocure;
        $this->countPricelist = $countPricelist;
        // Set pesan berdasarkan tipe download
        $this->message = $type === 'brocure' ? 'New Brochure Download!' : 'New Pricelist Download!';
    }

    // /**
    //  * Get the channels the event should broadcast on.
    //  *
    //  * @return array<int, \Illuminate\Broadcasting\Channel>
    //  */
    public function broadcastOn()
    {
        return new Channel('download-channel'); // Gunakan Channel biasa dulu
    }

    public function broadcastAs()
    {
        return 'new-download';
    }
}
