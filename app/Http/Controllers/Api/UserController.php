<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mentionAutocomplete(Request $request)
    {
        $q = $request->query('q');
        $users = \App\Models\User::where('name', 'like', $q . '%')
            ->orWhere('username', 'like', $q . '%')
            ->limit(10)
            ->get(['id', 'name', 'username', 'avatar']);

        return response()->json(['suggestions' => $users]);
    }
}
