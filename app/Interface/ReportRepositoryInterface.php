<?php

namespace App\Interface;

use App\Models\Report;
use App\Models\User;

interface ReportRepositoryInterface
{
    public function create(User $user, array $data);
    public function list($filter = []);
    public function updateStatus(Report $report, string $status);
}
