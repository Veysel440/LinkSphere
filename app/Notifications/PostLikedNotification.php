<?php

namespace App\Notifications;

use App\Models\Like;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PostLikedNotification extends Notification
{
    use Queueable;

    public Like $like;

    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type'    => 'like',
            'post_id' => $this->like->post_id,
            'user_id' => $this->like->user_id,
            'message' => 'Paylaşımın beğenildi!'
        ];
    }
}
