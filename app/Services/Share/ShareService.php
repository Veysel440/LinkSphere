<?php

namespace App\Services\Share;


use App\Interface\ShareRepositoryInterface;
use App\Models\User;
use App\Models\Post;
use App\Services\User\UserActivityLogService;
use App\Enums\ActivityType;
use App\Events\PostShared;

class ShareService
{
    protected ShareRepositoryInterface $repository;
    protected UserActivityLogService $logService;

    public function __construct(ShareRepositoryInterface $repository, UserActivityLogService $logService)
    {
        $this->repository = $repository;
        $this->logService = $logService;
    }

    public function share(User $user, Post $post)
    {
        $share = $this->repository->share($user, $post);

        $this->logService->log($user, ActivityType::POST_SHARED, [
            'post_id' => $post->id,
        ]);

        event(new PostShared($user, $post));
        return $share;
    }

    public function count(Post $post): int
    {
        return $this->repository->count($post);
    }
}
