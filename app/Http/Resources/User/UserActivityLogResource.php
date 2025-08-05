<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserActivityLogResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'type'       => $this->type,
            'data'       => $this->data,
            'created_at' => $this->created_at->toDateTimeString(),
            'user'       => [
                'id'    => $this->user_id,
                'name'  => $this->user?->name,
                'email' => $this->user?->email,
            ],
        ];
    }
}
