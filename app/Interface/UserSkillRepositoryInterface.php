<?php

namespace App\Interface;

use App\Models\User;
use App\Models\UserSkill;

interface UserSkillRepositoryInterface
{
    public function getAll(User $user);

    public function findById(User $user, $id);

    public function create(User $user, array $data);

    public function update(UserSkill $skill, array $data);

    public function delete(UserSkill $skill);
}
