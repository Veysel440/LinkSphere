<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserConnection;
use App\Repositories\UserConnectionRepository;
use App\Events\ConnectionStatusChanged;

class UserConnectionService
{
    protected UserConnectionRepository $repository;

    public function __construct(UserConnectionRepository $repository)
    {
        $this->repository = $repository;
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


        event(new ConnectionStatusChanged($connection, $connection->status));

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


        event(new ConnectionStatusChanged($updatedConnection, $status));

        return $updatedConnection;
    }

    public function unfriend(User $user, $otherUserId)
    {

        $deleted = $this->repository->deleteConnection($user->id, $otherUserId);


        return $deleted;
    }

    public function block(User $user, $blockedUserId)
    {
        $blocked = $this->repository->blockUser($user->id, $blockedUserId);

        event(new ConnectionStatusChanged($blocked, 'blocked'));

        return $blocked;
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
