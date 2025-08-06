<?php

namespace App\Services\Like;

use App\Interface\LikeRepositoryInterface;
use App\Models\User;
use App\Models\Post;
use App\Services\User\UserActivityLogService;
use App\Enums\ActivityType;
use App\Events\PostLiked;

class LikeService
{
    protected LikeRepositoryInterface $repository;
    protected UserActivityLogService $logService;

    public function __construct(LikeRepositoryInterface $repository, UserActivityLogService $logService)
    {
        $this->repository = $repository;
        $this->logService = $logService;
    }

    public function toggle(User $user, Post $post)
    {
        $liked = $this->repository->toggleLike($user, $post);

        $this->logService->log($user, $liked ? ActivityType::POST_LIKED : ActivityType::POST_UNLIKED, [
            'post_id' => $post->id,
        ]);

        if ($liked) {
            event(new PostLiked($user, $post));
        }

        return $liked;
    }

    public function hasLiked(User $user, Post $post): bool
    {
        return $this->repository->hasLiked($user, $post);
    }

    public function count(Post $post): int
    {
        return $this->repository->count($post);
    }
}
