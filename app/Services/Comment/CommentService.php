<?php

namespace App\Services\Comment;


use App\Enums\ActivityType;
use App\Events\CommentCreated;
use App\Interface\CommentRepositoryInterface;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Services\Security\KeywordFilterService;
use App\Services\User\UserActivityLogService;

class CommentService
{
    protected CommentRepositoryInterface $repository;
    protected UserActivityLogService $logService;
    protected KeywordFilterService $filterService;

    public function __construct(
        CommentRepositoryInterface $repository,
        UserActivityLogService $logService,
        KeywordFilterService $filterService
    ) {
        $this->repository = $repository;
        $this->logService = $logService;
        $this->filterService = $filterService;
    }

    public function list(Post $post, $limit = 20)
    {
        return $this->repository->getPostComments($post, $limit);
    }

    public function create(User $user, Post $post, array $data)
    {
        if ($this->filterService->containsBannedWords($data['content'])) {
            throw new \Exception('Uygunsuz kelime kullanımı.');
        }

        $comment = $this->repository->create($user, $post, $data);

        $this->logService->log($user, ActivityType::COMMENT_CREATED, [
            'post_id'    => $post->id,
            'comment_id' => $comment->id,
        ]);

        event(new CommentCreated($comment));
        $post->increment('comment_count');

        return $comment;
    }

    public function update(Comment $comment, array $data)
    {
        return $this->repository->update($comment, $data);
    }

    public function delete(Comment $comment)
    {
        $comment->post->decrement('comment_count');
        return $this->repository->delete($comment);
    }
}
