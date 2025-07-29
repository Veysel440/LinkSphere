<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserSocial;
use App\Repositories\UserSocialRepository;
use App\Services\UserActivityLogService;
use App\Enums\ActivityType;

class UserSocialService
{
    protected UserSocialRepository $repository;
    protected UserActivityLogService $logService;

    public function __construct(
        UserSocialRepository $repository,
        UserActivityLogService $logService
    ) {
        $this->repository = $repository;
        $this->logService = $logService;
    }

    public function list(User $user)
    {
        return $this->repository->getAll($user);
    }

    public function get(User $user, $id)
    {
        return $this->repository->findById($user, $id);
    }

    public function create(User $user, array $data)
    {
        $social = $this->repository->create($user, $data);

        $this->logService->log($user, ActivityType::SOCIAL_ADDED, [
            'social_id' => $social->id,
            'platform'  => $social->platform ?? null,
            'url'       => $social->url ?? null,
        ]);
        return $social;
    }

    public function update(UserSocial $social, array $data)
    {
        $result = $this->repository->update($social, $data);

        $this->logService->log($social->user, ActivityType::SOCIAL_UPDATED, [
            'social_id'      => $social->id,
            'updated_fields' => array_keys($data),
        ]);
        return $result;
    }

    public function delete(UserSocial $social)
    {
        $result = $this->repository->delete($social);

        $this->logService->log($social->user, ActivityType::SOCIAL_DELETED, [
            'social_id' => $social->id,
            'platform'  => $social->platform ?? null,
        ]);
        return $result;
    }
}
