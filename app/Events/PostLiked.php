<?php

namespace App\Events;

use App\Models\Like;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostLiked
{
    use Dispatchable, SerializesModels;

    public Like $like;

    public function __construct(Like $like)
    {
        $this->like = $like;
    }
}
