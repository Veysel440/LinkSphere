<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSocialResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'platform' => $this->platform,
            'url'      => $this->url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
