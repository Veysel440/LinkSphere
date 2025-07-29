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
    ];
}
