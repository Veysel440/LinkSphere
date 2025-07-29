<?php

use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\UserActivityLogController;
use App\Http\Controllers\Api\UserAvatarController;
use App\Http\Controllers\Api\UserConnectionController;
use App\Http\Controllers\Api\UserEducationController;
use App\Http\Controllers\Api\UserExperienceController;
use App\Http\Controllers\Api\UserPasswordController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\UserSkillController;
use App\Http\Controllers\Api\UserSocialController;
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
});

Route::get('user/activity-logs-summary', [UserActivityLogController::class, 'summary']);
