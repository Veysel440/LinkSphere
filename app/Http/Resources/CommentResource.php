<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'user'      => [
                'id'   => $this->user->id,
                'name' => $this->user->name,
                'avatar' => $this->user->avatar,
            ],
            'content'   => $this->content,
            'created_at'=> $this->created_at,
        ];
    }
}
