<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    public function update(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id || $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        return !$user->is_banned;
    }

    public function view(User $user, Comment $comment): bool
    {
        return true;
    }
}
