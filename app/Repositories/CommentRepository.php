<?php

namespace App\Repositories;


use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function getPostComments(Post $post, $limit = 20)
    {
        return $post->comments()->with('user')->latest()->paginate($limit);
    }

    public function create(User $user, Post $post, array $data)
    {
        return $post->comments()->create([
            'user_id' => $user->id,
            'content' => $data['content'],
        ]);
    }

    public function update(Comment $comment, array $data)
    {
        $comment->update($data);
        return $comment;
    }

    public function delete(Comment $comment)
    {
        return $comment->delete();
    }
}
