<?php

namespace App\Repositories;

use App\Interface\UserEducationRepositoryInterface;
use App\Models\User;
use App\Models\UserEducation;

class UserEducationRepository implements UserEducationRepositoryInterface
{
    public function getAll(User $user)
    {
        return $user->educations()->orderByDesc('start_date')->get();
    }

    public function findById(User $user, $id)
    {
        return $user->educations()->where('id', $id)->first();
    }

    public function create(User $user, array $data)
    {
        return $user->educations()->create($data);
    }

    public function update(UserEducation $education, array $data)
    {
        $education->update($data);
        return $education;
    }

    public function delete(UserEducation $education)
    {
        return $education->delete();
    }
}
