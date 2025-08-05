<?php

namespace App\Interface;

use App\Models\Post;
use App\Models\User;

interface PostRepositoryInterface
{
    public function getFeed(User $user, $limit = 20);
    public function create(User $user, array $data);
    public function find($id);
    public function update(Post $post, array $data);
    public function delete(Post $post);
}
