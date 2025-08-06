<?php

namespace App\Repositories;


use App\Interface\LikeRepositoryInterface;
use App\Models\Post;
use App\Models\User;
class LikeRepository implements LikeRepositoryInterface
{
    public function toggleLike(User $user, Post $post)
    {
        $like = $post->likes()->where('user_id', $user->id)->first();
        if ($like) {
            $like->delete();
            $post->decrement('like_count');
            return false;
        }
        $post->likes()->create(['user_id' => $user->id]);
        $post->increment('like_count');
        return true;
    }

    public function hasLiked(User $user, Post $post): bool
    {
        return $post->likes()->where('user_id', $user->id)->exists();
    }

    public function count(Post $post): int
    {
        return $post->likes()->count();
    }
}
