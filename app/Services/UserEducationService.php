<?php

namespace App\Services;


use App\Models\User;
use App\Models\UserEducation;
use App\Repositories\UserEducationRepository;

class UserEducationService
{
    protected UserEducationRepository $repository;

    public function __construct(UserEducationRepository $repository)
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

    public function update(UserEducation $education, array $data)
    {
        return $this->repository->update($education, $data);
    }

    public function delete(UserEducation $education)
    {
        return $this->repository->delete($education);
    }
}
