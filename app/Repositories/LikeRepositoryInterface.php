<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Post;

interface LikeRepositoryInterface
{
    public function like(User $user, Post $post);
    public function unlike(User $user, Post $post);
    public function isLiked(User $user, Post $post): bool;
}
