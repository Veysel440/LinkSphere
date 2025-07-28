<?php

namespace App\Notifications;

use App\Models\UserConnection;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConnectionNotification extends Notification
{
    use Dispatchable, SerializesModels;

    public $connection;
    public $status;

    public function __construct(UserConnection $connection, $status)
    {
        $this->connection = $connection;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'connection_id' => $this->connection->id,
            'status' => $this->status,
            'sender_id' => $this->connection->sender_id,
        ];
    }
}
