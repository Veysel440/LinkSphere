<?php

namespace App\Services\Post;

use App\Interface\PostRepositoryInterface;
use App\Models\Post;
use App\Models\User;
use App\Enums\ActivityType;
use App\Events\PostCreated;
use App\Services\User\UserActivityLogService;
use App\Services\Security\KeywordFilterService;

class PostService
{
    protected PostRepositoryInterface $repository;
    protected UserActivityLogService $logService;
    protected KeywordFilterService $filterService;

    public function __construct(
        PostRepositoryInterface $repository,
        UserActivityLogService $logService,
        KeywordFilterService $filterService
    ) {
        $this->repository   = $repository;
        $this->logService   = $logService;
        $this->filterService= $filterService;
    }

    public function getFeed(User $user, $limit = 20)
    {
        return $this->repository->getFeed($user, $limit);
    }

    public function create(User $user, array $data)
    {
        if (!empty($data['content']) && $this->filterService->containsBannedWords($data['content'])) {
            throw new \Exception('Gönderide uygunsuz kelime var.');
        }

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
        if (!empty($data['content']) && $this->filterService->containsBannedWords($data['content'])) {
            throw new \Exception('Gönderide uygunsuz kelime var.');
        }

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
