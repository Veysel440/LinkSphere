<?php

namespace App\Repositories;

use App\Interface\MessageRepositoryInterface;
use App\Models\User;
use App\Models\Message;

class MessageRepository implements MessageRepositoryInterface
{
    public function send(User $sender, int $receiverId, string $content): Message
    {
        return Message::create([
            'sender_id'   => $sender->id,
            'receiver_id' => $receiverId,
            'content'     => trim($content),
            'is_read'     => false,
        ]);
    }

    public function conversation(User $user, int $otherUserId, $limit = 30)
    {
        return Message::where(function($q) use ($user, $otherUserId) {
            $q->where('sender_id', $user->id)->where('receiver_id', $otherUserId);
        })->orWhere(function($q) use ($user, $otherUserId) {
            $q->where('sender_id', $otherUserId)->where('receiver_id', $user->id);
        })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function unreadCount(User $user, int $fromUserId = null): int
    {
        $q = Message::where('receiver_id', $user->id)->where('is_read', false);
        if ($fromUserId) {
            $q->where('sender_id', $fromUserId);
        }
        return $q->count();
    }

    public function markAsRead(Message $message): Message
    {
        $message->is_read = true;
        $message->save();
        return $message;
    }
}
