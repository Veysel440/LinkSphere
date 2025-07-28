<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserAvatarService
{
    public function updateAvatar(User $user, $file)
    {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $file->store('avatars', 'public');

        $user->avatar = $path;
        $user->save();

        return $user;
    }
}
