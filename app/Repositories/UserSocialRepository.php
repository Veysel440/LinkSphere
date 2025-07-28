<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserSocial;

class UserSocialRepository
{
    public function getAll(User $user)
    {
        return $user->socials()->orderBy('platform')->get();
    }

    public function findById(User $user, $id): ?UserSocial
    {
        return $user->socials()->where('id', $id)->first();
    }

    public function create(User $user, array $data): UserSocial
    {
        return $user->socials()->create($data);
    }

    public function update(UserSocial $social, array $data): bool
    {
        return $social->update($data);
    }

    public function delete(UserSocial $social): bool
    {
        return $social->delete();
    }
}
