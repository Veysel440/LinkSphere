<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;

class PostController extends Controller
{
    protected PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $feed = $this->service->getFeed($request->user(), $request->query('limit', 20));
        return PostResource::collection($feed);
    }

    public function store(PostRequest $request)
    {
        $post = $this->service->create($request->user(), $request->validated());
        return new PostResource($post);
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
        $updated = $this->service->update($post, $request->validated());
        return new PostResource($updated);
    }

    public function destroy(Request $request, $id)
    {
        $post = $this->service->find($id);
        if (!$post) {
            return response()->json(['message' => 'Gönderi bulunamadı!'], 404);
        }
        $this->service->delete($post);
        return response()->json(['message' => 'Gönderi silindi!']);
    }
}
