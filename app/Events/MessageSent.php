<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;
    public $toUserId;

    public function __construct(Message $message, $toUserId)
    {
        $this->message = $message;
        $this->toUserId = $toUserId;
    }

    public function broadcastOn()
    {
        return new Channel('chat.' . $this->toUserId);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'sender_id' => $this->message->sender_id,
            'content' => $this->message->content,
            'media' => $this->message->media,
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
    }
}
