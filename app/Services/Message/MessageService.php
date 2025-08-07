<?php

namespace App\Services\Message;

use App\Interface\MessageRepositoryInterface;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use App\Notifications\MessageSentNotification;

class MessageService
{
    protected MessageRepositoryInterface $repository;

    public function __construct(MessageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function send(User $sender, int $receiverId, string $content): Message
    {
        $message = $this->repository->send($sender, $receiverId, $content);

        event(new MessageSent($message));
        $message->receiver->notify(new MessageSentNotification($message));

        return $message;
    }

    public function getConversation(User $user, int $otherUserId, $limit = 30)
    {
        return $this->repository->conversation($user, $otherUserId, $limit);
    }

    public function markAsRead(Message $message): Message
    {
        return $this->repository->markAsRead($message);
    }

    public function unreadCount(User $user, int $fromUserId = null): int
    {
        return $this->repository->unreadCount($user, $fromUserId);
    }
}
