<?php

namespace App\Interface;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;

interface LikeRepositoryInterface
{
    public function toggleLike(User $user, Post $post);
    public function hasLiked(User $user, Post $post): bool;
    public function count(Post $post): int;
}
