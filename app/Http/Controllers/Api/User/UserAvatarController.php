<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserAvatarRequest;
use App\Services\User\UserAvatarService;

class UserAvatarController extends Controller
{
    protected UserAvatarService $avatarService;

    public function __construct(UserAvatarService $avatarService)
    {
        $this->avatarService = $avatarService;
    }

    public function update(UpdateUserAvatarRequest $request)
    {
        $user = $request->user();
        $this->avatarService->updateAvatar($user, $request->file('avatar'));
        return response()->json([
            'message' => 'Profil fotoğrafı başarıyla güncellendi!',
            'avatar_url' => $user->avatar ? asset('storage/' . $user->avatar) : null
        ]);
    }
}
