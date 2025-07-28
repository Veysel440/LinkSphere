<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserSkill;

class UserSkillRepository
{
    public function getAll(User $user)
    {
        return $user->skills()->orderByDesc('level')->get();
    }

    public function findById(User $user, $id): ?UserSkill
    {
        return $user->skills()->where('id', $id)->first();
    }

    public function create(User $user, array $data): UserSkill
    {
        return $user->skills()->create($data);
    }

    public function update(UserSkill $skill, array $data): bool
    {
        return $skill->update($data);
    }

    public function delete(UserSkill $skill): bool
    {
        return $skill->delete();
    }
}
