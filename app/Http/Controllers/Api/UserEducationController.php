<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserEducationRequest;
use App\Http\Resources\UserEducationResource;
use App\Services\UserEducationService;
use Illuminate\Http\Request;
class UserEducationController extends Controller
{
    protected UserEducationService $service;

    public function __construct(UserEducationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $educations = $this->service->list($request->user());
        return UserEducationResource::collection($educations);
    }

    public function show(Request $request, $id)
    {
        $education = $this->service->get($request->user(), $id);
        if (!$education) {
            return response()->json(['message' => 'Eğitim kaydı bulunamadı!'], 404);
        }
        return new UserEducationResource($education);
    }

    public function store(UserEducationRequest $request)
    {
        $education = $this->service->create($request->user(), $request->validated());
        return new UserEducationResource($education);
    }

    public function update(UserEducationRequest $request, $id)
    {
        $education = $this->service->get($request->user(), $id);
        if (!$education) {
            return response()->json(['message' => 'Eğitim kaydı bulunamadı!'], 404);
        }
        $updated = $this->service->update($education, $request->validated());
        return new UserEducationResource($updated);
    }

    public function destroy(Request $request, $id)
    {
        $education = $this->service->get($request->user(), $id);
        if (!$education) {
            return response()->json(['message' => 'Eğitim kaydı bulunamadı!'], 404);
        }
        $this->service->delete($education);
        return response()->json(['message' => 'Eğitim kaydı silindi!']);
    }
}
