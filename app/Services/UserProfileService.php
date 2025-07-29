<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserProfileRepository;
use App\Services\UserActivityLogService;
use App\Enums\ActivityType;

class UserProfileService
{
    protected UserProfileRepository $profileRepository;
    protected UserActivityLogService $logService;

    public function __construct(
        UserProfileRepository $profileRepository,
        UserActivityLogService $logService
    ) {
        $this->profileRepository = $profileRepository;
        $this->logService = $logService;
    }

    public function getUserProfile(User $user)
    {
        return $this->profileRepository->getProfileWithRelations($user);
    }

    public function updateUserProfile(User $user, array $data)
    {
        $profile = $this->profileRepository->updateOrCreateProfile($user, $data);

        $this->logService->log($user, ActivityType::PROFILE_UPDATED, [
            'updated_fields' => array_keys($data),
        ]);

        return $profile;
    }

    public function updateUserPrivacy(User $user, array $data)
    {
        $privacy = $this->profileRepository->updateOrCreatePrivacy($user, $data);

        $this->logService->log($user, ActivityType::PROFILE_UPDATED, [
            'privacy_changes' => array_keys($data),
        ]);

        return $privacy;
    }
}
