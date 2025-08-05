<?php

namespace App\Http\Controllers\Api\Message;

use App\Http\Controllers\Api\Request;

class MessageController
{
    public function send(Request $request)
    {
        $receiver = \App\Models\User::findOrFail($request->input('receiver_id'));
        $message = $this->service->sendPrivate($request->user(), $receiver, $request->all());
        return response()->json(['message' => $message]);
    }

    public function list(Request $request, $userId)
    {
        $messages = \App\Models\Message::where(function ($q) use ($request, $userId) {
            $q->where('sender_id', $request->user()->id)->where('receiver_id', $userId);
        })->orWhere(function ($q) use ($request, $userId) {
            $q->where('sender_id', $userId)->where('receiver_id', $request->user()->id);
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['messages' => $messages]);
    }

}
