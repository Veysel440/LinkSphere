<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments() { return $this->hasMany(Comment::class); }
    public function likes() { return $this->hasMany(Like::class); }
    public function shares() { return $this->hasMany(Share::class); }
}
