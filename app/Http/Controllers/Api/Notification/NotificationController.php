<?php

namespace App\Http\Controllers\Api\Notification;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->paginate(30);

        return response()->json(['notifications' => $notifications]);
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
