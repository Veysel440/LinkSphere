<?php

namespace App\Repositories;

use App\Interface\ReportRepositoryInterface;
use App\Models\Report;
use App\Models\User;

class ReportRepository implements ReportRepositoryInterface
{
    public function create(User $user, array $data)
    {
        $data['user_id'] = $user->id;
        $data['status'] = 'pending';
        return Report::create($data);
    }

    public function list($filter = [])
    {
        return Report::when($filter['status'] ?? null, fn($q, $status) => $q->where('status', $status))
            ->with(['user', 'post', 'comment'])
            ->latest()->paginate(20);
    }

    public function updateStatus(Report $report, string $status)
    {
        $report->update(['status' => $status]);
        return $report;
    }
}
