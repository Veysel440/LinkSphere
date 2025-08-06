<?php

namespace App\Http\Resources\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'user_id'   => $this->user_id,
            'post_id'   => $this->post_id,
            'comment_id'=> $this->comment_id,
            'type'      => $this->type,
            'reason'    => $this->reason,
            'status'    => $this->status,
            'created_at'=> $this->created_at,
        ];
    }
}
