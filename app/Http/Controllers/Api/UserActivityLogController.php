<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserActivityLogResource;

class UserActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $type = $request->query('type');
        $dateFrom = $request->query('from');
        $dateTo = $request->query('to');
        $q = $request->query('q');

        $logs = $user->activityLogs()
            ->when($type, fn($q1) => $q1->where('type', $type))
            ->when($dateFrom, fn($q1) => $q1->whereDate('created_at', '>=', $dateFrom))
            ->when($dateTo, fn($q1) => $q1->whereDate('created_at', '<=', $dateTo))
            ->when($q, function ($q1) use ($q) {
                $q1->where(function ($sub) use ($q) {
                    $sub->where('data', 'like', '%' . $q . '%');
                });
            })
            ->orderByDesc('created_at')
            ->paginate(30);

        return UserActivityLogResource::collection($logs);
    }

    public function show(Request $request, $id)
    {
        $log = $request->user()->activityLogs()->findOrFail($id);
        return new UserActivityLogResource($log);
    }

    public function summary(Request $request)
    {
        $user = $request->user();

        $summary = $user->activityLogs()
            ->selectRaw('type, count(*) as total')
            ->groupBy('type')
            ->orderByDesc('total')
            ->get();

        return response()->json($summary);
    }
}
