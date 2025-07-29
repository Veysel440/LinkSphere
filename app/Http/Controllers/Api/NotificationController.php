<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->limit(50)->latest()->get();
        return response()->json($notifications);
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = $request->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['message' => 'Bildirim okundu.']);
        }
        return response()->json(['message' => 'Bildirim bulunamadı!'], 404);
    }
}
