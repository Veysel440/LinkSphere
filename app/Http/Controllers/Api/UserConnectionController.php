<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserConnectionService;
use Illuminate\Http\Request;

use App\Http\Resources\UserResource;
class UserConnectionController extends Controller
{
    protected UserConnectionService $service;

    public function __construct(UserConnectionService $service)
    {
        $this->service = $service;
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $users = $this->service->searchUsers($query);
        return UserResource::collection($users);
    }

    public function sendRequest(Request $request)
    {
        try {
            $connection = $this->service->sendRequest($request->user(), $request->input('receiver_id'));
            return response()->json(['message' => 'Bağlantı isteği gönderildi.', 'data' => $connection]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function respondRequest(Request $request, $id)
    {
        $status = $request->input('status'); // accepted/rejected
        try {
            $connection = $this->service->respondRequest($request->user(), $id, $status);
            return response()->json(['message' => 'Bağlantı isteği güncellendi.', 'data' => $connection]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function connections(Request $request)
    {
        $connections = $this->service->connections($request->user());
        return response()->json($connections);
    }


    public function followers(Request $request)
    {
        $followers = $this->service->followers($request->user());
        return response()->json($followers);
    }


    public function following(Request $request)
    {
        $following = $this->service->following($request->user());
        return response()->json($following);
    }

    public function unfriend(Request $request)
    {
        $otherUserId = $request->input('user_id');
        $deleted = $this->service->unfriend($request->user(), $otherUserId);
        return response()->json(['message' => 'Bağlantı silindi.']);
    }

    public function block(Request $request)
    {
        $blockedUserId = $request->input('user_id');
        $blocked = $this->service->block($request->user(), $blockedUserId);
        return response()->json(['message' => 'Kullanıcı engellendi.', 'data' => $blocked]);
    }

    public function pending(Request $request)
    {
        $pending = $this->service->pendingRequests($request->user());
        return response()->json($pending);
    }
}
