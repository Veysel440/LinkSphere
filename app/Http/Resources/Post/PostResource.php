<?php

namespace App\Http\Resources\Post;


use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'user'      => [
                'id'     => $this->user->id,
                'name'   => $this->user->name,
                'avatar' => $this->user->avatar,
            ],
            'type'          => $this->type,
            'content'       => $this->content,
            'media'         => is_array($this->media) ? $this->media : [],
            'tags'          => $this->tags ?? [],
            'like_count'    => $this->like_count,
            'comment_count' => $this->comment_count,
            'share_count'   => $this->share_count,
            'created_at'    => $this->created_at->toISOString(),
            'updated_at'    => $this->updated_at?->toISOString(),

            'is_owner'      => $request->user() && $this->user_id === $request->user()->id,
            'can_edit'      => $request->user()?->can('update', $this->resource) ?? false,
            'can_delete'    => $request->user()?->can('delete', $this->resource) ?? false,
        ];
    }
}
