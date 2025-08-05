<?php

namespace App\Providers;

use App\Interface\CommentRepositoryInterface;
use App\Interface\LikeRepositoryInterface;
use App\Interface\PostRepositoryInterface;
use App\Interface\ShareRepositoryInterface;
use App\Interface\UserEducationRepositoryInterface;
use App\Interface\UserExperienceRepositoryInterface;
use App\Interface\UserProfileRepositoryInterface;
use App\Interface\UserSkillRepositoryInterface;
use App\Interface\UserSocialRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\LikeRepository;
use App\Repositories\PostRepository;
use App\Repositories\ShareRepository;
use App\Repositories\UserEducationRepository;
use App\Repositories\UserExperienceRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserSkillRepository;
use App\Repositories\UserSocialRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        $this->app->bind(UserProfileRepositoryInterface::class, UserProfileRepository::class);
        $this->app->bind(UserExperienceRepositoryInterface::class, UserExperienceRepository::class);
        $this->app->bind(UserEducationRepositoryInterface::class, UserEducationRepository::class);
        $this->app->bind(UserSkillRepositoryInterface::class, UserSkillRepository::class);
        $this->app->bind(UserSocialRepositoryInterface::class, UserSocialRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(LikeRepositoryInterface::class, LikeRepository::class);
        $this->app->bind(ShareRepositoryInterface::class, ShareRepository::class);
        $this->app->singleton(\App\Services\Security\KeywordFilterService::class);

    }

    public function boot(): void
    {
        //
    }
}
