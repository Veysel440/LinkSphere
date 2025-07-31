<?php

namespace App\Events;

use App\Models\Share;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostShared
{
    use Dispatchable, SerializesModels;

    public Share $share;

    public function __construct(Share $share)
    {
        $this->share = $share;
    }
}
