<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasPushSubscriptions;

    use Notifiable;

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
    public function experiences()
    {
        return $this->hasMany(UserExperience::class);
    }
    public function educations()
    {
        return $this->hasMany(UserEducation::class);
    }
    public function skills()
    {
        return $this->hasMany(UserSkill::class);
    }
    public function socials()
    {
        return $this->hasMany(UserSocial::class);
    }
    public function privacy()
    {
        return $this->hasOne(UserPrivacy::class);
    }
    public function activityLogs()
    {
        return $this->hasMany(UserActivityLog::class);
    }

    public function comments() { return $this->hasMany(Comment::class); }
    public function likes() { return $this->hasMany(Like::class); }
    public function share() { return $this->hasMany(Share::class); }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
