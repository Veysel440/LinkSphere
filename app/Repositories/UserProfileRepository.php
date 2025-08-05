<?php

namespace App\Repositories;

use App\Interface\UserProfileRepositoryInterface;
use App\Models\User;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    public function getProfileWithRelations(User $user)
    {
        return $user->load(['profile', 'experiences', 'educations', 'skills', 'socials', 'privacy']);
    }

    public function updateOrCreateProfile(User $user, array $data)
    {
        return $user->profile()->updateOrCreate(['user_id' => $user->id], $data);
    }

    public function updateOrCreatePrivacy(User $user, array $data)
    {
        return $user->privacy()->updateOrCreate(['user_id' => $user->id], $data);
    }
}
