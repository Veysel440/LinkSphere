<?php

namespace App\Services\User;

use App\Events\UserActivityLogged;
use App\Models\User;
use App\Models\UserActivityLog;

class UserActivityLogService
{
    /**
     * Kullanıcı aktivite logu oluştur ve event fırlat
     *
     * @param User   $user  Aktif kullanıcı modeli
     * @param string $type  Log tipi (örn: 'profile_updated', 'connection_sent' vs.)
     * @param array  $data  Ekstra log verisi (opsiyonel)
     * @return UserActivityLog
     */
    public function log(User $user, string $type, array $data = []): UserActivityLog
    {
        $log = UserActivityLog::create([
            'user_id' => $user->id,
            'type'    => $type,
            'data'    => $data,
        ]);

        event(new UserActivityLogged($log));

        return $log;
    }
}
