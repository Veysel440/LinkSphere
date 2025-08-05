<?php

namespace App\Http\Controllers\Api\Comment;


use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Services\Comment\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected CommentService $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
        $this->middleware('auth:sanctum');
        $this->middleware('throttle:30,1');
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

        try {
            $comment = $this->service->create($request->user(), $post, $request->validated());
            return new CommentResource($comment);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(CommentRequest $request, $postId, $id)
    {
        $comment = Comment::where('post_id', $postId)->findOrFail($id);

        if ($request->user()->cannot('update', $comment)) {
            return response()->json(['message' => 'Yetkisiz'], 403);
        }

        $this->service->update($comment, $request->validated());
        return new CommentResource($comment);
    }

    public function destroy(Request $request, $postId, $id)
    {
        $comment = Comment::where('post_id', $postId)->findOrFail($id);

        if ($request->user()->cannot('delete', $comment)) {
            return response()->json(['message' => 'Yetkisiz'], 403);
        }

        $this->service->delete($comment);
        return response()->json(['message' => 'Yorum silindi!']);
    }
}
