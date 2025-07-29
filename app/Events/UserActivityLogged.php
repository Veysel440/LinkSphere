<?php

namespace App\Events;

use App\Models\UserActivityLog;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class UserActivityLogged
{
    use Dispatchable, SerializesModels;

    public $activityLog;

    public function __construct(UserActivityLog $activityLog)
    {
        $this->activityLog = $activityLog;
    }
}
