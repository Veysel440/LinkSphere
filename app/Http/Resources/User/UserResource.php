<?php

namespace App\Http\Resources;

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'avatar'=> $this->avatar ? asset('storage/'.$this->avatar) : null,
            'headline' => $this->profile->headline ?? null,
        ];
    }
}
