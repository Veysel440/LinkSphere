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

        $receiver = User::find($connection->receiver_id);

        Notification::send($receiver, new ConnectionNotification($connection, $status));
    }
}
