<?php

namespace App\Repositories;


use App\Interface\ShareRepositoryInterface;
use App\Models\Post;
use App\Models\User;
class ShareRepository implements ShareRepositoryInterface
{
    public function share(User $user, Post $post)
    {
        $share = $post->shares()->firstOrCreate([
            'user_id' => $user->id
        ]);
        $post->increment('share_count');
        return $share;
    }

    public function count(Post $post): int
    {
        return $post->shares()->count();
    }
}
