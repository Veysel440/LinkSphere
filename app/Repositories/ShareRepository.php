<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Post;

class ShareRepository implements ShareRepositoryInterface
{
    public function share(User $user, Post $post)
    {
        return $post->shares()->create([
            'user_id' => $user->id
        ]);
    }
}
