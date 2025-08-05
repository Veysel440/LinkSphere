<?php

namespace App\Http\Controllers\Api\Like;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\Like\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected LikeService $service;

    public function __construct(LikeService $service)
    {
        $this->service = $service;
    }

    public function like(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $this->service->like($request->user(), $post);
        return response()->json(['liked' => true]);
    }

    public function unlike(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $this->service->unlike($request->user(), $post);
        return response()->json(['liked' => false]);
    }
}
