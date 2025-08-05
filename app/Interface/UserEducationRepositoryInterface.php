<?php

namespace App\Interface;

use App\Models\User;
use App\Models\UserEducation;

interface UserEducationRepositoryInterface
{
    public function getAll(User $user);

    public function findById(User $user, $id);

    public function create(User $user, array $data);

    public function update(UserEducation $education, array $data);

    public function delete(UserEducation $education);
}
