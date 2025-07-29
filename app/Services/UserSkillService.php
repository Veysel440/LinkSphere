<?php

namespace App\Services;


use App\Models\User;
use App\Models\UserSkill;
use App\Repositories\UserSkillRepository;
use App\Services\UserActivityLogService;
use App\Enums\ActivityType;

class UserSkillService
{
    protected UserSkillRepository $repository;
    protected UserActivityLogService $logService;

    public function __construct(
        UserSkillRepository $repository,
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
        $skill = $this->repository->create($user, $data);

        $this->logService->log($user, ActivityType::SKILL_ADDED, [
            'skill_id' => $skill->id,
            'skill'    => $skill->skill ?? null,
            'level'    => $skill->level ?? null,
        ]);

        return $skill;
    }

    public function update(UserSkill $skill, array $data)
    {
        $result = $this->repository->update($skill, $data);

        $this->logService->log($skill->user, ActivityType::SKILL_UPDATED, [
            'skill_id'       => $skill->id,
            'updated_fields' => array_keys($data),
        ]);

        return $result;
    }

    public function delete(UserSkill $skill)
    {
        $result = $this->repository->delete($skill);

        $this->logService->log($skill->user, ActivityType::SKILL_DELETED, [
            'skill_id' => $skill->id,
            'skill'    => $skill->skill ?? null,
        ]);

        return $result;
    }
}
