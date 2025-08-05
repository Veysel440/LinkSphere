<?php

namespace App\Repositories;

use App\Interface\ShareRepositoryInterface;
use App\Models\Post;
use App\Models\User;

class ShareRepository implements ShareRepositoryInterface
{
    public function share(User $user, Post $post)
    {
        return $post->shares()->create([
            'user_id' => $user->id
        ]);
    }
}
