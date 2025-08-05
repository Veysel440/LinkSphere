<?php

namespace App\Interface;


use App\Models\User;

interface UserProfileRepositoryInterface
{
    public function getProfileWithRelations(User $user);

    public function updateOrCreateProfile(User $user, array $data);

    public function updateOrCreatePrivacy(User $user, array $data);
}
