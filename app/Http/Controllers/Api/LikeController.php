<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LikeService;
use App\Models\Post;
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
