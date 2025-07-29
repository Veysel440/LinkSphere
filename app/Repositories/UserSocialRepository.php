<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserSocial;

class UserSocialRepository implements UserSocialRepositoryInterface
{
    public function getAll(User $user)
    {
        return $user->socials()->orderByDesc('created_at')->get();
    }

    public function findById(User $user, $id)
    {
        return $user->socials()->where('id', $id)->first();
    }

    public function create(User $user, array $data)
    {
        return $user->socials()->create($data);
    }

    public function update(UserSocial $social, array $data)
    {
        $social->update($data);
        return $social;
    }

    public function delete(UserSocial $social)
    {
        return $social->delete();
    }
}
