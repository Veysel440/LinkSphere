<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserExperience;

class UserExperienceRepository implements UserExperienceRepositoryInterface
{
    public function getAll(User $user)
    {
        return $user->experiences()->orderByDesc('start_date')->get();
    }

    public function findById(User $user, $id)
    {
        return $user->experiences()->where('id', $id)->first();
    }

    public function create(User $user, array $data)
    {
        return $user->experiences()->create($data);
    }

    public function update(UserExperience $experience, array $data)
    {
        $experience->update($data);
        return $experience;
    }

    public function delete(UserExperience $experience)
    {
        return $experience->delete();
    }
}
