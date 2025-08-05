<?php

namespace App\Interface;

use App\Models\Post;
use App\Models\User;

interface ShareRepositoryInterface
{
    public function share(User $user, Post $post);
}
