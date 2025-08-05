<?php

namespace App\Http\Controllers\Api\Share;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\Share\ShareService;
use Illuminate\Http\Request;


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
