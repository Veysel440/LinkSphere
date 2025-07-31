<?php

namespace App\Listeners;

use App\Events\PostLiked;
use App\Notifications\PostLikedNotification;

class SendPostLikedNotification
{
    public function handle(PostLiked $event)
    {
        $postOwner = $event->like->post->user;
        if ($postOwner->id !== $event->like->user_id) {
            $postOwner->notify(new PostLikedNotification($event->like));
        }
    }
}
