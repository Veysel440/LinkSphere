<?php

namespace App\Services;


use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Repositories\CommentRepositoryInterface;
use App\Services\UserActivityLogService;
use App\Enums\ActivityType;
use App\Events\CommentCreated;

class CommentService
{
    protected CommentRepositoryInterface $repository;
    protected UserActivityLogService $logService;

    public function __construct(CommentRepositoryInterface $repository, UserActivityLogService $logService)
    {
        $this->repository = $repository;
        $this->logService = $logService;
    }

    public function list(Post $post, $limit = 20)
    {
        return $this->repository->getPostComments($post, $limit);
    }

    public function create(User $user, Post $post, array $data)
    {
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
