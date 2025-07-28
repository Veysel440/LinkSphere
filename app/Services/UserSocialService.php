<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserSocial;
use App\Repositories\UserSocialRepository;

class UserSocialService
{
    protected UserSocialRepository $repository;

    public function __construct(UserSocialRepository $repository)
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

    public function update(UserSocial $social, array $data)
    {
        return $this->repository->update($social, $data);
    }

    public function delete(UserSocial $social)
    {
        return $this->repository->delete($social);
    }
}
