<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\UserExperience;
use App\Repositories\UserExperienceRepository;

class UserExperienceService
{
    protected UserExperienceRepository $repository;

    public function __construct(UserExperienceRepository $repository)
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

    public function update(UserExperience $experience, array $data)
    {
        return $this->repository->update($experience, $data);
    }

    public function delete(UserExperience $experience)
    {
        return $this->repository->delete($experience);
    }
}
