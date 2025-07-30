<?php

namespace App\Notifications;

use App\Models\UserEducation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class EducationCreatedNotification extends Notification
{
    use Queueable;

    protected UserEducation $education;

    public function __construct(UserEducation $education)
    {
        $this->education = $education;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'education_id' => $this->education->id,
            'school'       => $this->education->school,
            'degree'       => $this->education->degree,
            'message'      => 'Yeni bir eğitim bilgisi eklendi!',
        ];
    }
}
