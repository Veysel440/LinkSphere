<?php

namespace App\Repositories;


use App\Interface\LikeRepositoryInterface;
use App\Models\Post;
use App\Models\User;

class LikeRepository implements LikeRepositoryInterface
{
    public function like(User $user, Post $post)
    {
        return $post->likes()->firstOrCreate(['user_id' => $user->id]);
    }

    public function unlike(User $user, Post $post)
    {
        return $post->likes()->where('user_id', $user->id)->delete();
    }

    public function isLiked(User $user, Post $post): bool
    {
        return $post->likes()->where('user_id', $user->id)->exists();
    }
}
