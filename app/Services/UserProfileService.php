<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserProfileRepository;

class UserProfileService
{
    protected UserProfileRepository $profileRepository;

    public function __construct(UserProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function getUserProfile(User $user)
    {
        return $this->profileRepository->getProfileWithRelations($user);
    }

    public function updateUserProfile(User $user, array $data)
    {
        return $this->profileRepository->updateOrCreateProfile($user, $data);
    }

    public function updateUserPrivacy(User $user, array $data)
    {
        return $this->profileRepository->updateOrCreatePrivacy($user, $data);
    }
}
