<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserExperienceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company'     => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:2000',
        ];
    }
}
