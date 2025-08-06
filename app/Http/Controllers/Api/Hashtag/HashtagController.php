<?php

namespace App\Http\Controllers\Api\Hashtag;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HashtagController extends Controller
{
    public function trends()
    {
        $trends = DB::table('posts')
            ->select(DB::raw('JSON_UNQUOTE(JSON_EXTRACT(tags, CONCAT("$[", n.n, "]"))) as tag'))
            ->join(DB::raw('(SELECT 0 n UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) n'), DB::raw('JSON_LENGTH(tags) > n.n'), [])
            ->whereNotNull('tags')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('tag')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(10)
            ->pluck('tag');

        return response()->json(['trends' => $trends]);
    }

    public function autocomplete(Request $request)
    {
        $q = $request->query('q');
        $tags = DB::table('posts')
            ->select(DB::raw('JSON_UNQUOTE(JSON_EXTRACT(tags, CONCAT("$[", n.n, "]"))) as tag'))
            ->join(DB::raw('(SELECT 0 n UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) n'), DB::raw('JSON_LENGTH(tags) > n.n'), [])
            ->whereNotNull('tags')
            ->whereRaw('JSON_UNQUOTE(JSON_EXTRACT(tags, CONCAT("$[", n.n, "]"))) LIKE ?', ["$q%"])
            ->groupBy('tag')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(10)
            ->pluck('tag');
        return response()->json(['suggestions' => $tags]);
    }

    public function posts($tag)
    {
        $posts = Post::whereJsonContains('tags', $tag)
            ->with('user')
            ->latest()
            ->paginate(20);

        return response()->json(['tag' => $tag, 'posts' => $posts]);
    }
}
