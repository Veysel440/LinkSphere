<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'avatar'     => $this->avatar,
            'email_verified_at' => $this->email_verified_at,
            'profile'    => $this->profile ? [
                'summary'   => $this->profile->summary,
                'headline'  => $this->profile->headline,
                'birth_date'=> $this->profile->birth_date,
                'location'  => $this->profile->location,
            ] : null,
            'experiences' => $this->experiences ? $this->experiences->map(function($exp) {
                return [
                    'id'         => $exp->id,
                    'company'    => $exp->company,
                    'position'   => $exp->position,
                    'start_date' => $exp->start_date,
                    'end_date'   => $exp->end_date,
                    'description'=> $exp->description,
                ];
            }) : [],
            'educations' => $this->educations ? $this->educations->map(function($edu) {
                return [
                    'id'         => $edu->id,
                    'school'     => $edu->school,
                    'degree'     => $edu->degree,
                    'department' => $edu->department,
                    'start_date' => $edu->start_date,
                    'end_date'   => $edu->end_date,
                ];
            }) : [],
            'skills' => $this->skills ? $this->skills->map(function($skill) {
                return [
                    'id'    => $skill->id,
                    'skill' => $skill->skill,
                    'level' => $skill->level,
                ];
            }) : [],
            'socials' => $this->socials ? $this->socials->map(function($social) {
                return [
                    'id'       => $social->id,
                    'platform' => $social->platform,
                    'url'      => $social->url,
                ];
            }) : [],
            'privacy' => $this->privacy ? [
                'profile_visible'        => (bool) $this->privacy->profile_visible,
                'can_receive_messages'   => (bool) $this->privacy->can_receive_messages,
                'share_activity_status'  => (bool) $this->privacy->share_activity_status,
            ] : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
