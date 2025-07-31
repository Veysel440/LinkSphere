<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Notifications\CommentCreatedNotification;

class SendCommentCreatedNotification
{
    public function handle(CommentCreated $event)
    {
        $postOwner = $event->comment->post->user;

        if ($postOwner->id !== $event->comment->user_id) {
            $postOwner->notify(new CommentCreatedNotification($event->comment));
        }
    }
}
