<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    protected $fillable = [
        'user_id', 'company', 'position', 'start_date', 'end_date', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
