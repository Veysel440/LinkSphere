<?php

namespace App\Interface;

use App\Models\Post;
use App\Models\User;

interface LikeRepositoryInterface
{
    public function like(User $user, Post $post);
    public function unlike(User $user, Post $post);
    public function isLiked(User $user, Post $post): bool;
}
