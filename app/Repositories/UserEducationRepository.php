<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserEducation;

class UserEducationRepository
{
    public function getAll(User $user)
    {
        return $user->educations()->orderByDesc('start_date')->get();
    }

    public function findById(User $user, $id): ?UserEducation
    {
        return $user->educations()->where('id', $id)->first();
    }

    public function create(User $user, array $data): UserEducation
    {
        return $user->educations()->create($data);
    }

    public function update(UserEducation $education, array $data): bool
    {
        return $education->update($data);
    }

    public function delete(UserEducation $education): bool
    {
        return $education->delete();
    }
}
