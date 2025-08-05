<?php

use App\Http\Controllers\Api\Comment\CommentController;
use App\Http\Controllers\Api\Discover\DiscoverController;
use App\Http\Controllers\Api\Hashtag\HashtagController;
use App\Http\Controllers\Api\Like\LikeController;
use App\Http\Controllers\Api\Notification\NotificationController;
use App\Http\Controllers\Api\Share\ShareController;
use App\Http\Controllers\Api\User\UserActivityLogController;
use App\Http\Controllers\Api\User\UserAvatarController;
use App\Http\Controllers\Api\User\UserConnectionController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\UserEducationController;
use App\Http\Controllers\Api\User\UserExperienceController;
use App\Http\Controllers\Api\User\UserPasswordController;
use App\Http\Controllers\Api\User\UserProfileController;
use App\Http\Controllers\Api\User\UserSkillController;
use App\Http\Controllers\Api\User\UserSocialController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {


    Route::get('user/profile', [UserProfileController::class, 'show']);
    Route::put('user/profile', [UserProfileController::class, 'updateProfile']);
    Route::get('user/privacy', [UserProfileController::class, 'showPrivacy']);
    Route::put('user/privacy', [UserProfileController::class, 'updatePrivacy']);


    Route::apiResource('user/experiences', UserExperienceController::class)->except(['create', 'edit']);
    Route::apiResource('user/educations', UserEducationController::class)->except(['create', 'edit']);
    Route::apiResource('user/skills', UserSkillController::class)->except(['create', 'edit']);
    Route::apiResource('user/socials', UserSocialController::class)->except(['create', 'edit']);
    Route::apiResource('posts', \App\Http\Controllers\Api\Post\PostController::class);

    Route::post('user/avatar', [UserAvatarController::class, 'update']);
    Route::post('user/password', [UserPasswordController::class, 'update']);


    Route::get('users/search', [UserConnectionController::class, 'search']);
    Route::post('connections/request', [UserConnectionController::class, 'sendRequest']);
    Route::post('connections/respond/{id}', [UserConnectionController::class, 'respondRequest']);
    Route::get('connections', [UserConnectionController::class, 'connections']);
    Route::get('connections/followers', [UserConnectionController::class, 'followers']);
    Route::get('connections/following', [UserConnectionController::class, 'following']);
    Route::get('connections/pending', [UserConnectionController::class, 'pending']);
    Route::post('connections/unfriend', [UserConnectionController::class, 'unfriend']);
    Route::post('connections/block', [UserConnectionController::class, 'block']);


    Route::get('notifications', [NotificationController::class, 'index']);
    Route::post('notifications/read/{id}', [NotificationController::class, 'markAsRead']);

    Route::get('connections/suggestions', [UserConnectionController::class, 'suggest']);

    Route::get('user/activity-logs', [UserActivityLogController::class, 'index']);
    Route::get('user/activity-logs/{id}', [UserActivityLogController::class, 'show']);

    Route::get('posts/{post}/comments', [CommentController::class, 'index']);
    Route::post('posts/{post}/comments', [CommentController::class, 'store']);
    Route::put('posts/{post}/comments/{id}', [CommentController::class, 'update']);
    Route::delete('posts/{post}/comments/{id}', [CommentController::class, 'destroy']);
    Route::post('posts/{post}/like', [LikeController::class, 'like']);
    Route::post('posts/{post}/unlike', [LikeController::class, 'unlike']);
    Route::post('posts/{post}/share', [ShareController::class, 'share']);

    Route::get('trends/hashtags', [HashtagController::class, 'trends']);
    Route::get('hashtags/{tag}/posts', [HashtagController::class, 'search']);


});

Route::get('user/activity-logs-summary', [UserActivityLogController::class, 'summary']);
Route::get('hashtags/autocomplete', [HashtagController::class, 'autocomplete']);
Route::get('users/autocomplete', [UserController::class, 'mentionAutocomplete']);
Route::middleware('auth:sanctum')->get('discover/posts', [DiscoverController::class, 'posts']);
Route::middleware('auth:sanctum')->get('discover/users', [DiscoverController::class, 'users']);
