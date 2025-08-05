<?php

namespace App\Services\Message;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;

class MessageService
{
    public function sendPrivate(User $sender, User $receiver, array $data)
    {
        $message = Message::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'content' => $data['content'] ?? null,
            'media' => $data['media'] ?? null,
        ]);

        event(new MessageSent($message, $receiver->id));
        return $message;
    }

    public function sendGroup(User $sender, $groupId, array $data)
    {
        $message = Message::create([
            'sender_id' => $sender->id,
            'group_id' => $groupId,
            'content' => $data['content'] ?? null,
            'media' => $data['media'] ?? null,
        ]);

        return $message;
    }

    public function markAsRead(Message $message)
    {
        $message->is_read = true;
        $message->save();
    }
}
