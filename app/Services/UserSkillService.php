<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserSkill;
use App\Repositories\UserSkillRepository;

class UserSkillService
{
    protected UserSkillRepository $repository;

    public function __construct(UserSkillRepository $repository)
    {
        $this->repository = $repository;
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
        return $this->repository->create($user, $data);
    }

    public function update(UserSkill $skill, array $data)
    {
        return $this->repository->update($skill, $data);
    }

    public function delete(UserSkill $skill)
    {
        return $this->repository->delete($skill);
    }
}
