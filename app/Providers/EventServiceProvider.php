<?php

namespace App\Providers;

class EventServiceProvider
{
    protected $listen = [
        \App\Events\ConnectionStatusChanged::class => [
            \App\Listeners\SendConnectionNotification::class,
        ],
        \App\Events\UserActivityLogged::class => [
            \App\Listeners\SendActivityNotification::class,
        ],
            \App\Events\EducationCreated::class => [
                \App\Listeners\SendEducationCreatedNotification::class,
            ],
        \App\Events\CommentCreated::class => [
            \App\Listeners\SendCommentCreatedNotification::class,
        ],
        \App\Events\PostLiked::class => [
            \App\Listeners\SendPostLikedNotification::class,
        ],
        \App\Events\PostShared::class => [
            \App\Listeners\SendPostSharedNotification::class,
        ],
    ];
}
