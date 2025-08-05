<?php

namespace App\Repositories;


use App\Interface\PostRepositoryInterface;
use App\Models\Post;
use App\Models\User;

class PostRepository implements PostRepositoryInterface
{
    public function getFeed(User $user, $limit = 20)
    {
        $followingIds = $user->followings()->pluck('id')->toArray() ?? [];
        $ids = array_unique(array_merge([$user->id], $followingIds));
        return Post::whereIn('user_id', $ids)
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
