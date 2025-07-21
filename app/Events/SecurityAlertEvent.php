<?php
namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class SecurityAlertEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $alert;

    public function __construct($alert)
    {
        $this->alert = [
            'time'       => now()->toDateTimeString(),
            'type'       => $alert['type'] ?? '-',
            'ip'         => $alert['ip'] ?? '-',
            'user_agent' => request()->header('User-Agent', '-'),
            'url'        => request()->fullUrl(),
            'extra'      => $alert['extra'] ?? '-',
        ];

        // Simpan ke log file
        $this->storeToLog();
    }

    public function broadcastOn()
    {
        return new PrivateChannel('super-admin.alerts');
    }

    public function broadcastAs()
    {
        return 'security.alert';
    }

    protected function storeToLog()
    {
        $logPath = storage_path('logs/blocked_requests.log');
        file_put_contents($logPath, json_encode($this->alert) . PHP_EOL, FILE_APPEND);
    }
}
