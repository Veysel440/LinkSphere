<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Notifications\Notification;

class MessageSentNotification extends Notification
{
    public Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'type'       => 'message',
            'from_user'  => $this->message->sender->name,
            'content'    => $this->message->content,
            'message_id' => $this->message->id,
        ];
    }
}
