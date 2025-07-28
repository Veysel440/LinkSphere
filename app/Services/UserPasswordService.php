<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserPasswordService
{
    public function updatePassword(User $user, $currentPassword, $newPassword)
    {
        if (!Hash::check($currentPassword, $user->password)) {
            return false;
        }
        $user->password = Hash::make($newPassword);
        $user->save();
        return true;
    }
}
