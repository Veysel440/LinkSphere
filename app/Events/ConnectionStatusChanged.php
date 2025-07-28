<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\UserConnection;

class ConnectionStatusChanged
{
    use Dispatchable, SerializesModels;

    public $connection;
    public $status;

    public function __construct(UserConnection $connection, $status)
    {
        $this->connection = $connection;
        $this->status = $status;
    }
}
