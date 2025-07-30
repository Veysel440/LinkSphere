<?php

namespace App\Services;

use App\Enums\ActivityType;
use App\Models\Post;
use App\Models\User;
use App\Repositories\LikeRepositoryInterface;

class LikeService
{
    protected LikeRepositoryInterface $repository;
    protected UserActivityLogService $logService;

    public function __construct(LikeRepositoryInterface $repository, UserActivityLogService $logService)
    {
        $this->repository = $repository;
        $this->logService = $logService;
    }

    public function like(User $user, Post $post)
    {
        $like = $this->repository->like($user, $post);
        $post->increment('like_count');

        $this->logService->log($user, ActivityType::POST_LIKED, [
            'post_id' => $post->id,
        ]);

        return $like;
    }

    public function unlike(User $user, Post $post)
    {
        $result = $this->repository->unlike($user, $post);
        $post->decrement('like_count');

        $this->logService->log($user, ActivityType::POST_UNLIKED, [
            'post_id' => $post->id,
        ]);

        return $result;
    }

    public function isLiked(User $user, Post $post): bool
    {
        return $this->repository->isLiked($user, $post);
    }
}
