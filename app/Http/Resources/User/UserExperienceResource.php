<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserExperienceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'company'     => $this->company,
            'position'    => $this->position,
            'start_date'  => $this->start_date,
            'end_date'    => $this->end_date,
            'description' => $this->description,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
