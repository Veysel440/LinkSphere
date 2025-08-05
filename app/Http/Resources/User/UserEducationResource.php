<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserEducationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'school'     => $this->school,
            'degree'     => $this->degree,
            'department' => $this->department,
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
