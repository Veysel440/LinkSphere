<?php

namespace App\Listeners;

use App\Events\UserActivityLogged;
use App\Models\User;
use App\Notifications\GenericActivityNotification;

class SendActivityNotification
{
    public function handle(UserActivityLogged $event)
    {
        $log = $event->activityLog;
        $user = $log->user;
        if ($user) {
            $user->notify(new GenericActivityNotification($log));
        }
    }
}
