<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->role === 'admin';
    }
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->role === 'admin';
    }
    public function create(User $user)
    {
        return !$user->is_banned;
    }
    public function like(User $user, Post $post)
    {
        return !$user->is_banned;
    }
    public function share(User $user, Post $post)
    {
        return !$user->is_banned;
    }
}
