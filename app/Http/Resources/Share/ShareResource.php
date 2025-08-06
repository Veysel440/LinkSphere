<?php

namespace App\Http\Resources\Share;

use Illuminate\Http\Resources\Json\JsonResource;

class ShareResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'user_id' => $this->user_id,
            'post_id' => $this->post_id,
        ];
    }
}
