<?php

namespace App\Events;

use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Events\Dispatchable;

class PostLiked
{
    use Dispatchable;

    public function __construct(
        public User $user,
        public Post $post
    ) {}
}
