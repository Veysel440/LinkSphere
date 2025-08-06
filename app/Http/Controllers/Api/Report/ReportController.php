<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\ReportRequest;
use App\Http\Resources\Report\ReportResource;
use App\Models\Report;
use App\Services\Report\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected ReportService $service;

    public function __construct(ReportService $service)
    {
        $this->service = $service;
        $this->middleware('auth:sanctum');
    }

    public function store(ReportRequest $request)
    {
        $report = $this->service->create($request->user(), $request->validated());
        return new ReportResource($report);
    }

    public function index(Request $request)
    {
        $reports = $this->service->list($request->query());
        return ReportResource::collection($reports);
    }

    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $updated = $this->service->updateStatus($report, $request->input('status', 'resolved'));
        return new ReportResource($updated);
    }
}
