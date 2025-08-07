<?php

namespace App\Http\Controllers\Api\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\SendMessageRequest;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;
use App\Services\Message\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected MessageService $service;

    public function __construct(MessageService $service)
    {
        $this->service = $service;
        $this->middleware('auth:sanctum');
    }

    public function conversation(Request $request, $otherUserId)
    {
        $messages = $this->service->getConversation($request->user(), $otherUserId);
        return MessageResource::collection($messages);
    }

    public function send(SendMessageRequest $request)
    {
        $msg = $this->service->send(
            $request->user(),
            $request->input('receiver_id'),
            $request->input('content')
        );
        return new MessageResource($msg);
    }

    public function markAsRead(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $this->service->markAsRead($message);
        return new MessageResource($message);
    }

    public function unreadCount(Request $request, $fromUserId = null)
    {
        $count = $this->service->unreadCount($request->user(), $fromUserId);
        return response()->json(['unread' => $count]);
    }
}
