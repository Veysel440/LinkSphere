<?php

namespace App\Events;

use App\Models\User;
use App\Models\UserEducation;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EducationCreated
{
    use Dispatchable, SerializesModels;

    public User $user;
    public UserEducation $education;

    public function __construct(User $user, UserEducation $education)
    {
        $this->user = $user;
        $this->education = $education;
    }
}
