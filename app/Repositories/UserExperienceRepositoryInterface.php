<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserExperience;

interface UserExperienceRepositoryInterface
{
    public function getAll(User $user);

    public function findById(User $user, $id);

    public function create(User $user, array $data);

    public function update(UserExperience $experience, array $data);

    public function delete(UserExperience $experience);
}
