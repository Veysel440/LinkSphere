<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class HashtagController extends Controller
{
    public function trends()
    {
        $trends = Post::select(DB::raw('JSON_UNQUOTE(JSON_EXTRACT(tags, CONCAT("$[", n.n, "]"))) as tag'))
            ->join(DB::raw('(SELECT 0 as n UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) as n'), DB::raw('JSON_LENGTH(tags) > n.n'), [])
            ->whereNotNull('tags')
            ->groupBy('tag')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(10)
            ->pluck('tag');

        return response()->json(['trends' => $trends]);
    }

    public function search($tag)
    {
        $posts = Post::whereJsonContains('tags', $tag)->latest()->with('user')->paginate(20);

        return response()->json([
            'tag' => $tag,
            'posts' => $posts,
        ]);
    }
}
