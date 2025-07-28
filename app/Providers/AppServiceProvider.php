<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\UserProfileRepository::class,
            \App\Repositories\UserProfileRepository::class
        );
        $this->app->bind(
            \App\Services\UserProfileService::class,
            \App\Services\UserProfileService::class
        );

        $this->app->bind(
            \App\Repositories\UserExperienceRepository::class,
            \App\Repositories\UserExperienceRepository::class
        );
        $this->app->bind(
            \App\Services\UserExperienceService::class,
            \App\Services\UserExperienceService::class
        );

        $this->app->bind(
            \App\Repositories\UserEducationRepository::class,
            \App\Repositories\UserEducationRepository::class
        );
        $this->app->bind(
            \App\Services\UserEducationService::class,
            \App\Services\UserEducationService::class
        );

        $this->app->bind(
            \App\Repositories\UserSkillRepository::class,
            \App\Repositories\UserSkillRepository::class
        );
        $this->app->bind(
            \App\Services\UserSkillService::class,
            \App\Services\UserSkillService::class
        );

        $this->app->bind(
            \App\Repositories\UserSocialRepository::class,
            \App\Repositories\UserSocialRepository::class
        );
        $this->app->bind(
            \App\Services\UserSocialService::class,
            \App\Services\UserSocialService::class
        );
    }

    public function boot(): void
    {
        //
    }
}
