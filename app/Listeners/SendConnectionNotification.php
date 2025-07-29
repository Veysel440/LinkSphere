<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ConnectionStatusChanged;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ConnectionNotification;

class SendConnectionNotification
{
    public function handle(ConnectionStatusChanged $event)
    {
        $connection = $event->connection;
        $status = $event->status;

        if ($status === 'pending') {
            $receiver = User::find($connection->receiver_id);
            $receiver?->notify(new ConnectionNotification($connection, $status));
        } else {
            $sender = User::find($connection->sender_id);
            $sender?->notify(new ConnectionNotification($connection, $status));
        }
    }
}
