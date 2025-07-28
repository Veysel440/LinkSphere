<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserConnection;

class UserConnectionRepository
{
    public function deleteConnection($userId, $otherUserId)
    {
        return UserConnection::where(function ($q) use ($userId, $otherUserId) {
            $q->where('sender_id', $userId)->where('receiver_id', $otherUserId);
        })->orWhere(function ($q) use ($userId, $otherUserId) {
            $q->where('sender_id', $otherUserId)->where('receiver_id', $userId);
        })->delete();
    }

    public function blockUser($userId, $blockedUserId)
    {
        $connection = UserConnection::where(function ($q) use ($userId, $blockedUserId) {
            $q->where('sender_id', $userId)->where('receiver_id', $blockedUserId);
        })->orWhere(function ($q) use ($userId, $blockedUserId) {
            $q->where('sender_id', $blockedUserId)->where('receiver_id', $userId);
        })->first();

        if ($connection) {
            $connection->status = 'blocked';
            $connection->save();
            return $connection;
        }

        return UserConnection::create([
            'sender_id' => $userId,
            'receiver_id' => $blockedUserId,
            'status' => 'blocked'
        ]);
    }
    public function searchUsers($query)
    {
        return User::where(function($q) use ($query) {
            $q->where('name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%")
                ->orWhereHas('profile', function($qq) use ($query) {
                    $qq->where('headline', 'like', "%$query%");
                });
        })->limit(20)->get();
    }

    public function findConnection($senderId, $receiverId)
    {
        return UserConnection::where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->first();
    }

    public function createConnection($senderId, $receiverId)
    {
        return UserConnection::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 'pending'
        ]);
    }

    public function updateStatus(UserConnection $connection, $status)
    {
        $connection->status = $status;
        $connection->save();
        return $connection;
    }

    public function getConnections(User $user)
    {
        return UserConnection::where(function ($q) use ($user) {
            $q->where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id);
        })->where('status', 'accepted')->get();
    }

    public function getFollowers(User $user)
    {
        return UserConnection::where('receiver_id', $user->id)
            ->where('status', 'accepted')->get();
    }

    public function getFollowing(User $user)
    {
        return UserConnection::where('sender_id', $user->id)
            ->where('status', 'accepted')->get();
    }

    public function getPendingRequests(User $user)
    {
        return UserConnection::where('receiver_id', $user->id)
            ->where('status', 'pending')->get();
    }
}
