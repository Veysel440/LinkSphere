<?php

namespace App\Services\Report;

use App\Interface\ReportRepositoryInterface;
use App\Models\Report;
use App\Models\User;
use App\Services\User\UserActivityLogService;
use App\Enums\ActivityType;

class ReportService
{
    protected ReportRepositoryInterface $repository;
    protected UserActivityLogService $logService;

    public function __construct(ReportRepositoryInterface $repository, UserActivityLogService $logService)
    {
        $this->repository = $repository;
        $this->logService = $logService;
    }

    public function create(User $user, array $data)
    {
        $report = $this->repository->create($user, $data);

        $this->logService->log($user, ActivityType::REPORT_CREATED, [
            'report_id' => $report->id,
            'type'      => $report->type,
        ]);

        return $report;
    }

    public function list($filter = [])
    {
        return $this->repository->list($filter);
    }

    public function updateStatus(Report $report, string $status)
    {
        return $this->repository->updateStatus($report, $status);
    }
}
