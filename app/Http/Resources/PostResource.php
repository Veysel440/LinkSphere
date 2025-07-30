<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'type'      => $this->type,
            'content'   => $this->content,
            'media'     => $this->media,
            'tags'      => $this->tags,
            'like_count'    => $this->like_count,
            'comment_count' => $this->comment_count,
            'share_count'   => $this->share_count,
            'created_at'    => $this->created_at,
        ];
    }
}
