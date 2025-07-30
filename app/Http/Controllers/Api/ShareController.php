<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShareService;
use App\Models\Post;


class ShareController extends Controller
{
    protected ShareService $service;

    public function __construct(ShareService $service)
    {
        $this->service = $service;
    }

    public function share(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $share = $this->service->share($request->user(), $post);
        return response()->json(['message' => 'Paylaşıldı', 'share_id' => $share->id]);
    }
}
