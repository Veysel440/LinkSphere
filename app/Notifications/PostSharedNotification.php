<?php

namespace App\Notifications;

use App\Models\Share;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PostSharedNotification extends Notification
{
    use Queueable;

    public Share $share;

    public function __construct(Share $share)
    {
        $this->share = $share;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type'    => 'share',
            'post_id' => $this->share->post_id,
            'user_id' => $this->share->user_id,
            'message' => 'Paylaşımın başkası tarafından paylaşıldı!'
        ];
    }
}
