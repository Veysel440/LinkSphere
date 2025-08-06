<?php

namespace App\Http\Controllers\Api\Like;

use App\Http\Controllers\Controller;
use App\Http\Requests\Like\LikeRequest;
use App\Http\Resources\Like\LikeResource;
use App\Models\Post;
use App\Services\Like\LikeService;

class LikeController extends Controller
{
    protected LikeService $service;

    public function __construct(LikeService $service)
    {
        $this->service = $service;
        $this->middleware('auth:sanctum');
    }

    public function toggle(LikeRequest $request)
    {
        $post = Post::findOrFail($request->input('post_id'));
        $liked = $this->service->toggle($request->user(), $post);
        return response()->json(['liked' => $liked]);
    }
}
