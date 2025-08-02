<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CommentCreatedNotification extends Notification
{
    use Queueable;

    public Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }


    public function toDatabase($notifiable)
    {
        return [
            'type'      => 'comment',
            'post_id'   => $this->comment->post_id,
            'comment_id'=> $this->comment->id,
            'user_id'   => $this->comment->user_id,
            'message'   => 'Paylaşımına yeni bir yorum yapıldı!'
        ];
    }

    public function via($notifiable)
    {
        return ['database', 'mail', 'webpush'];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new \NotificationChannels\WebPush\WebPushMessage)
            ->title('Yeni yorum!')
            ->icon('/icon.png')
            ->body($this->comment->user->name . ' paylaşımına yorum yaptı!')
            ->action('Gör', url('/posts/' . $this->comment->post_id));
    }
}
