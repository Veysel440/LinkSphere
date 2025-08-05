<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'summary'    => 'nullable|string|max:500',
            'headline'   => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
            'location'   => 'nullable|string|max:150',
        ];
    }
}
