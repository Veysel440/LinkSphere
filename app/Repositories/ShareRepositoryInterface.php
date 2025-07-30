<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Post;

interface ShareRepositoryInterface
{
    public function share(User $user, Post $post);
}
