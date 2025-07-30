<?php

namespace App\Providers;

use App\Repositories\CommentRepository;
use App\Repositories\CommentRepositoryInterface;
use App\Repositories\LikeRepository;
use App\Repositories\LikeRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\ShareRepository;
use App\Repositories\ShareRepositoryInterface;
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
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(LikeRepositoryInterface::class, LikeRepository::class);
        $this->app->bind(ShareRepositoryInterface::class, ShareRepository::class);

    }

    public function boot(): void
    {
        //
    }
}
