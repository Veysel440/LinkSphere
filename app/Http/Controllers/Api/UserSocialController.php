<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSocialRequest;
use App\Http\Resources\UserSocialResource;
use App\Services\UserSocialService;
use Illuminate\Http\Request;

class UserSocialController extends Controller
{
    protected UserSocialService $service;

    public function __construct(UserSocialService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $socials = $this->service->list($request->user());
        return UserSocialResource::collection($socials);
    }

    public function show(Request $request, $id)
    {
        $social = $this->service->get($request->user(), $id);
        if (!$social) {
            return response()->json(['message' => 'Sosyal medya bağlantısı bulunamadı!'], 404);
        }
        return new UserSocialResource($social);
    }

    public function store(UserSocialRequest $request)
    {
        $social = $this->service->create($request->user(), $request->validated());
        return new UserSocialResource($social);
    }

    public function update(UserSocialRequest $request, $id)
    {
        $social = $this->service->get($request->user(), $id);
        if (!$social) {
            return response()->json(['message' => 'Sosyal medya bağlantısı bulunamadı!'], 404);
        }
        $this->service->update($social, $request->validated());
        return new UserSocialResource($social);
    }

    public function destroy(Request $request, $id)
    {
        $social = $this->service->get($request->user(), $id);
        if (!$social) {
            return response()->json(['message' => 'Sosyal medya bağlantısı bulunamadı!'], 404);
        }
        $this->service->delete($social);
        return response()->json(['message' => 'Sosyal medya bağlantısı silindi!']);
    }
}
