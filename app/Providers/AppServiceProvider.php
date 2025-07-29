<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserProfileRepositoryInterface;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserExperienceRepositoryInterface;
use App\Repositories\UserExperienceRepository;
use App\Repositories\UserEducationRepositoryInterface;
use App\Repositories\UserEducationRepository;
use App\Repositories\UserSkillRepositoryInterface;
use App\Repositories\UserSkillRepository;
use App\Repositories\UserSocialRepositoryInterface;
use App\Repositories\UserSocialRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        $this->app->bind(UserProfileRepositoryInterface::class, UserProfileRepository::class);
        $this->app->bind(UserExperienceRepositoryInterface::class, UserExperienceRepository::class);
        $this->app->bind(UserEducationRepositoryInterface::class, UserEducationRepository::class);
        $this->app->bind(UserSkillRepositoryInterface::class, UserSkillRepository::class);
        $this->app->bind(UserSocialRepositoryInterface::class, UserSocialRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
