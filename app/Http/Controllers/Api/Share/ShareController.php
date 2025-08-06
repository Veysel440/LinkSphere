<?php

namespace App\Http\Controllers\Api\Share;

use App\Http\Controllers\Controller;
use App\Http\Requests\Share\ShareRequest;
use App\Http\Resources\Share\ShareResource;
use App\Models\Post;
use App\Services\Share\ShareService;

class ShareController extends Controller
{
    protected ShareService $service;

    public function __construct(ShareService $service)
    {
        $this->service = $service;
        $this->middleware('auth:sanctum');
    }

    public function share(ShareRequest $request)
    {
        $post = Post::findOrFail($request->input('post_id'));
        $share = $this->service->share($request->user(), $post);
        return new ShareResource($share);
    }
}
