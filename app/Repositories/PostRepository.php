<?php

namespace App\Repositories;


use App\Models\User;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function getFeed(User $user, $limit = 20)
    {
        return Post::whereIn('user_id', [$user->id] + $user->followings()->pluck('id')->toArray())
            ->latest()
            ->with('user')
            ->paginate($limit);
    }

    public function create(User $user, array $data)
    {
        return $user->posts()->create($data);
    }

    public function find($id)
    {
        return Post::with('user')->find($id);
    }

    public function update(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}
