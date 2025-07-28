<?php

namespace App\Repositories;

use App\Models\UserExperience;
use App\Models\User;

class UserExperienceRepository
{
    public function getAll(User $user)
    {
        return $user->experiences()->orderByDesc('start_date')->get();
    }

    public function findById(User $user, $id): ?UserExperience
    {
        return $user->experiences()->where('id', $id)->first();
    }

    public function create(User $user, array $data): UserExperience
    {
        return $user->experiences()->create($data);
    }

    public function update(UserExperience $experience, array $data): bool
    {
        return $experience->update($data);
    }

    public function delete(UserExperience $experience): bool
    {
        return $experience->delete();
    }
}
