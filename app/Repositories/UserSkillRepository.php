<?php

namespace App\Repositories;

use App\Interface\UserSkillRepositoryInterface;
use App\Models\User;
use App\Models\UserSkill;

class UserSkillRepository implements UserSkillRepositoryInterface
{
    public function getAll(User $user)
    {
        return $user->skills()->orderByDesc('created_at')->get();
    }

    public function findById(User $user, $id)
    {
        return $user->skills()->where('id', $id)->first();
    }

    public function create(User $user, array $data)
    {
        return $user->skills()->create($data);
    }

    public function update(UserSkill $skill, array $data)
    {
        $skill->update($data);
        return $skill;
    }

    public function delete(UserSkill $skill)
    {
        return $skill->delete();
    }
}
