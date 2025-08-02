<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    public function posts(Request $request)
    {
        $user = $request->user();

        $query = \App\Models\Post::whereNotIn('user_id', $user->followings()->pluck('id')->push($user->id))
            ->orderByDesc('like_count')
            ->where('created_at', '>=', now()->subDays(7))
            ->with('user')
            ->limit(20);

        $posts = $query->get();
        return response()->json(['posts' => $posts]);
    }

    public function users(Request $request)
    {
        $user = $request->user();
        $exclude = $user->connections()->pluck('id')->push($user->id);
        $suggestions = \App\Models\User::whereNotIn('id', $exclude)
            ->withCount(['connections'])
            ->orderByDesc('connections_count')
            ->limit(10)
            ->get(['id', 'name', 'username', 'avatar']);
        return response()->json(['suggestions' => $suggestions]);
    }
}
