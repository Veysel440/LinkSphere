<?php

namespace App\Services;

use App\Models\User;
use App\Models\Post;
use App\Repositories\ShareRepositoryInterface;
use App\Services\UserActivityLogService;
use App\Enums\ActivityType;

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
        $post->increment('share_count');

        $this->logService->log($user, ActivityType::POST_SHARED, [
            'post_id' => $post->id,
            'share_id'=> $share->id,
        ]);

        return $share;
    }
}
