<?php

namespace App\Interface;

use App\Models\User;
use App\Models\Message;

interface MessageRepositoryInterface
{
    public function send(User $sender, int $receiverId, string $content): Message;
    public function conversation(User $user, int $otherUserId, $limit = 30);
    public function unreadCount(User $user, int $fromUserId = null): int;
    public function markAsRead(Message $message): Message;
}
