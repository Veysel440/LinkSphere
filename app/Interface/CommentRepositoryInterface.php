<?php

namespace App\Interface;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

interface CommentRepositoryInterface
{
    public function getPostComments(Post $post, $limit = 20);
    public function create(User $user, Post $post, array $data);
    public function update(Comment $comment, array $data);
    public function delete(Comment $comment);
}
