<?php

namespace App\Services;

use App\Models\User;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use App\Services\UserActivityLogService;
use App\Enums\ActivityType;
use App\Events\PostCreated;

class PostService
{
    protected PostRepositoryInterface $repository;
    protected UserActivityLogService $logService;

    public function __construct(PostRepositoryInterface $repository, UserActivityLogService $logService)
    {
        $this->repository = $repository;
        $this->logService = $logService;
    }

    public function getFeed(User $user, $limit = 20)
    {
        return $this->repository->getFeed($user, $limit);
    }

    public function create(User $user, array $data)
    {
        $post = $this->repository->create($user, $data);

        $this->logService->log($user, ActivityType::POST_CREATED, [
            'post_id' => $post->id,
            'type'    => $post->type,
        ]);

        event(new PostCreated($post));

        return $post;
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function update(Post $post, array $data)
    {
        $updated = $this->repository->update($post, $data);

        $this->logService->log($post->user, ActivityType::POST_UPDATED, [
            'post_id' => $post->id,
        ]);

        return $updated;
    }

    public function delete(Post $post)
    {
        $deleted = $this->repository->delete($post);

        $this->logService->log($post->user, ActivityType::POST_DELETED, [
            'post_id' => $post->id,
        ]);

        return $deleted;
    }
}
