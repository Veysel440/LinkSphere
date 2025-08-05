<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\Post\PostResource;
use App\Services\Post\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
        $this->middleware('auth:sanctum');
        $this->middleware('throttle:30,1');
    }

    public function index(Request $request)
    {
        $feed = $this->service->getFeed($request->user(), $request->query('limit', 20));
        return PostResource::collection($feed);
    }

    public function store(PostRequest $request)
    {
        try {
            $post = $this->service->create($request->user(), $request->validated());
            return new PostResource($post);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function show($id)
    {
        $post = $this->service->find($id);
        if (!$post) {
            return response()->json(['message' => 'Gönderi bulunamadı!'], 404);
        }
        return new PostResource($post);
    }

    public function update(PostRequest $request, $id)
    {
        $post = $this->service->find($id);
        if (!$post) {
            return response()->json(['message' => 'Gönderi bulunamadı!'], 404);
        }
        if ($request->user()->cannot('update', $post)) {
            return response()->json(['message' => 'Yetkisiz!'], 403);
        }
        $updated = $this->service->update($post, $request->validated());
        return new PostResource($updated);
    }

    public function destroy(Request $request, $id)
    {
        $post = $this->service->find($id);
        if (!$post) {
            return response()->json(['message' => 'Gönderi bulunamadı!'], 404);
        }
        if ($request->user()->cannot('delete', $post)) {
            return response()->json(['message' => 'Yetkisiz!'], 403);
        }
        $this->service->delete($post);
        return response()->json(['message' => 'Gönderi silindi!']);
    }
}
