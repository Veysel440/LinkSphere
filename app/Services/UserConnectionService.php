<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserConnection;
use App\Repositories\UserConnectionRepository;
use App\Events\ConnectionStatusChanged;
use App\Services\UserActivityLogService;
use App\Enums\ActivityType;

class UserConnectionService
{
    protected UserConnectionRepository $repository;
    protected UserActivityLogService $logService;

    public function __construct(
        UserConnectionRepository $repository,
        UserActivityLogService $logService
    ) {
        $this->repository = $repository;
        $this->logService = $logService;
    }

    public function searchUsers($query)
    {
        return $this->repository->searchUsers($query);
    }

    public function sendRequest(User $sender, $receiverId)
    {
        if ($sender->id == $receiverId) {
            throw new \Exception('Kendinize bağlantı isteği gönderemezsiniz.');
        }
        $existing = $this->repository->findConnection($sender->id, $receiverId);
        if ($existing) {
            throw new \Exception('Bağlantı isteği zaten mevcut.');
        }
        $connection = $this->repository->createConnection($sender->id, $receiverId);

        // Event ve log
        event(new ConnectionStatusChanged($connection, $connection->status));
        $this->logService->log($sender, ActivityType::CONNECTION_SENT, [
            'to_user_id' => $receiverId,
            'connection_id' => $connection->id,
        ]);

        return $connection;
    }

    public function respondRequest(User $user, $requestId, $status)
    {
        $connection = UserConnection::where('id', $requestId)
            ->where('receiver_id', $user->id)
            ->where('status', 'pending')
            ->first();
        if (!$connection) {
            throw new \Exception('Bağlantı isteği bulunamadı veya zaten yanıtlanmış.');
        }
        $updatedConnection = $this->repository->updateStatus($connection, $status);

        // Event ve log
        event(new ConnectionStatusChanged($updatedConnection, $status));
        $logType = match ($status) {
            'accepted' => ActivityType::CONNECTION_ACCEPTED,
            'rejected' => ActivityType::CONNECTION_REJECTED,
            'blocked'  => ActivityType::CONNECTION_BLOCKED,
            default    => 'connection_' . $status,
        };
        $this->logService->log($user, $logType, [
            'from_user_id' => $connection->sender_id,
            'connection_id' => $connection->id,
        ]);

        return $updatedConnection;
    }

    public function unfriend(User $user, $otherUserId)
    {
        $deleted = $this->repository->deleteConnection($user->id, $otherUserId);

        $this->logService->log($user, ActivityType::CONNECTION_DELETED, [
            'other_user_id' => $otherUserId,
        ]);

        return $deleted;
    }

    public function block(User $user, $blockedUserId)
    {
        $blocked = $this->repository->blockUser($user->id, $blockedUserId);

        // Event ve log
        event(new ConnectionStatusChanged($blocked, 'blocked'));
        $this->logService->log($user, ActivityType::CONNECTION_BLOCKED, [
            'blocked_user_id' => $blockedUserId,
            'connection_id'   => $blocked->id ?? null,
        ]);

        return $blocked;
    }

    public function suggestFriends(User $user, $limit = 10)
    {
        return $this->repository->suggestFriends($user, $limit);
    }

    public function connections(User $user)
    {
        return $this->repository->getConnections($user);
    }

    public function followers(User $user)
    {
        return $this->repository->getFollowers($user);
    }

    public function following(User $user)
    {
        return $this->repository->getFollowing($user);
    }

    public function pendingRequests(User $user)
    {
        return $this->repository->getPendingRequests($user);
    }
}
