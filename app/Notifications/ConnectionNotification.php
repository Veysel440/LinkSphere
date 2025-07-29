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
        $sender = $this->connection->sender()->first();
        return [
            'connection_id' => $this->connection->id,
            'sender_id'     => $this->connection->sender_id,
            'sender_name'   => $sender ? $sender->name : null,
            'sender_avatar' => $sender ? $sender->avatar : null,
            'status'        => $this->status,
            'message'       => $this->buildMessage($sender),
        ];
    }

    private function buildMessage($sender)
    {
        switch ($this->status) {
            case 'pending':
                return "{$sender->name} sana bağlantı isteği gönderdi.";
            case 'accepted':
                return "{$sender->name} bağlantı isteğini kabul etti!";
            case 'rejected':
                return "{$sender->name} bağlantı isteğini reddetti.";
            case 'blocked':
                return "{$sender->name} seni engelledi.";
            default:
                return "Bağlantı güncellemesi";
        }
    }
}
