<?php

namespace App\Interface;

use App\Models\User;
use App\Models\Post;

interface ShareRepositoryInterface
{
    public function share(User $user, Post $post);
    public function count(Post $post): int;
}
