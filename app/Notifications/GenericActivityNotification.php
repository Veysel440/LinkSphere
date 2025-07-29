<?php

namespace App\Notifications;

use App\Models\UserActivityLog;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GenericActivityNotification extends Notification
{
    use Queueable;

    protected $log;

    public function __construct(UserActivityLog $log)
    {
        $this->log = $log;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type'      => $this->log->type,
            'data'      => $this->log->data,
            'created_at'=> $this->log->created_at,
        ];
    }
}
