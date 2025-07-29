<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserSkillRequest;
use App\Http\Resources\UserSkillResource;
use App\Services\UserSkillService;

class UserSkillController extends Controller
{
    protected UserSkillService $service;

    public function __construct(UserSkillService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $skills = $this->service->list($request->user());
        return UserSkillResource::collection($skills);
    }

    public function show(Request $request, $id)
    {
        $skill = $this->service->get($request->user(), $id);
        if (!$skill) {
            return response()->json(['message' => 'Yetenek bulunamadı!'], 404);
        }
        return new UserSkillResource($skill);
    }

    public function store(UserSkillRequest $request)
    {
        $skill = $this->service->create($request->user(), $request->validated());
        return new UserSkillResource($skill);
    }

    public function update(UserSkillRequest $request, $id)
    {
        $skill = $this->service->get($request->user(), $id);
        if (!$skill) {
            return response()->json(['message' => 'Yetenek bulunamadı!'], 404);
        }
        $updated = $this->service->update($skill, $request->validated());
        return new UserSkillResource($updated);
    }

    public function destroy(Request $request, $id)
    {
        $skill = $this->service->get($request->user(), $id);
        if (!$skill) {
            return response()->json(['message' => 'Yetenek bulunamadı!'], 404);
        }
        $this->service->delete($skill);
        return response()->json(['message' => 'Yetenek silindi!']);
    }
}
