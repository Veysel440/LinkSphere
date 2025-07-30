<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Post;

interface PostRepositoryInterface
{
    public function getFeed(User $user, $limit = 20);
    public function create(User $user, array $data);
    public function find($id);
    public function update(Post $post, array $data);
    public function delete(Post $post);
}
