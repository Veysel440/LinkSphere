<?php

namespace App\Http\Resources\Message;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'sender'     => [
                'id'     => $this->sender->id,
                'name'   => $this->sender->name,
                'avatar' => $this->sender->avatar,
            ],
            'receiver'   => [
                'id'     => $this->receiver->id,
                'name'   => $this->receiver->name,
                'avatar' => $this->receiver->avatar,
            ],
            'content'    => $this->content,
            'is_read'    => $this->is_read,
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
