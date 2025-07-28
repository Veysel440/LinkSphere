<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserExperienceRequest;
use App\Http\Resources\UserExperienceResource;
use App\Services\UserExperienceService;
use Illuminate\Http\Request;

class UserExperienceController extends Controller
{
    protected UserExperienceService $service;

    public function __construct(UserExperienceService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $experiences = $this->service->list($request->user());
        return UserExperienceResource::collection($experiences);
    }

    public function show(Request $request, $id)
    {
        $experience = $this->service->get($request->user(), $id);
        if (!$experience) {
            return response()->json(['message' => 'Deneyim bulunamadı!'], 404);
        }
        return new UserExperienceResource($experience);
    }

    public function store(UserExperienceRequest $request)
    {
        $experience = $this->service->create($request->user(), $request->validated());
        return new UserExperienceResource($experience);
    }

    public function update(UserExperienceRequest $request, $id)
    {
        $experience = $this->service->get($request->user(), $id);
        if (!$experience) {
            return response()->json(['message' => 'Deneyim bulunamadı!'], 404);
        }
        $this->service->update($experience, $request->validated());
        return new UserExperienceResource($experience);
    }

    public function destroy(Request $request, $id)
    {
        $experience = $this->service->get($request->user(), $id);
        if (!$experience) {
            return response()->json(['message' => 'Deneyim bulunamadı!'], 404);
        }
        $this->service->delete($experience);
        return response()->json(['message' => 'Deneyim silindi!']);
    }
}
