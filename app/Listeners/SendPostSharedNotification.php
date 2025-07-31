<?php

namespace App\Listeners;

use App\Events\PostShared;
use App\Notifications\PostSharedNotification;

class SendPostSharedNotification
{
    public function handle(PostShared $event)
    {
        $postOwner = $event->share->post->user;
        if ($postOwner->id !== $event->share->user_id) {
            $postOwner->notify(new PostSharedNotification($event->share));
        }
    }
}
