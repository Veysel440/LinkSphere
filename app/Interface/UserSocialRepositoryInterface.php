<?php

namespace App\Interface;

use App\Models\User;
use App\Models\UserSocial;

interface UserSocialRepositoryInterface
{
    public function getAll(User $user);

    public function findById(User $user, $id);

    public function create(User $user, array $data);

    public function update(UserSocial $social, array $data);

    public function delete(UserSocial $social);
}
