<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Services\UserProfileService;

class UserProfileController extends Controller
{
    protected UserProfileService $profileService;

    public function __construct(UserProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function show(Request $request)
    {
        $user = $this->profileService->getUserProfile($request->user());
        return new UserProfileResource($user);
    }

    public function updateProfile(UpdateUserProfileRequest $request)
    {
        $this->profileService->updateUserProfile($request->user(), $request->only(['summary', 'headline', 'birth_date', 'location']));
        return response()->json(['message' => 'Profil güncellendi!']);
    }

    public function showPrivacy(Request $request)
    {
        $user = $request->user()->load('privacy');
        return response()->json([
            'privacy' => $user->privacy ? [
                'profile_visible' => (bool) $user->privacy->profile_visible,
                'can_receive_messages' => (bool) $user->privacy->can_receive_messages,
                'share_activity_status' => (bool) $user->privacy->share_activity_status,
            ] : null,
        ]);
    }

    public function updatePrivacy(Request $request)
    {
        $this->profileService->updateUserPrivacy($request->user(), $request->only(['profile_visible', 'can_receive_messages', 'share_activity_status']));
        return response()->json(['message' => 'Gizlilik ayarları güncellendi!']);
    }
}
