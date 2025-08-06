<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id', 'post_id', 'comment_id', 'type', 'reason', 'status',
    ];
    public function user() { return $this->belongsTo(User::class); }
    public function post() { return $this->belongsTo(Post::class); }
    public function comment() { return $this->belongsTo(Comment::class); }
}
