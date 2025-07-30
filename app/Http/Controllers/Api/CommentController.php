<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    protected CommentService $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $comments = $this->service->list($post, $request->query('limit', 20));
        return CommentResource::collection($comments);
    }

    public function store(CommentRequest $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $comment = $this->service->create($request->user(), $post, $request->validated());
        return new CommentResource($comment);
    }

    public function update(CommentRequest $request, $postId, $id)
    {
        $comment = Comment::where('post_id', $postId)->findOrFail($id);
        $this->service->update($comment, $request->validated());
        return new CommentResource($comment);
    }

    public function destroy(Request $request, $postId, $id)
    {
        $comment = Comment::where('post_id', $postId)->findOrFail($id);
        $this->service->delete($comment);
        return response()->json(['message' => 'Yorum silindi!']);
    }
}
