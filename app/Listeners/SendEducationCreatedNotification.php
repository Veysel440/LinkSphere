<?php

namespace App\Listeners;

use App\Events\EducationCreated;
use App\Notifications\EducationCreatedNotification;

class SendEducationCreatedNotification
{
    public function handle(EducationCreated $event)
    {
        $event->user->notify(new EducationCreatedNotification($event->education));
    }
}
