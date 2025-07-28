<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEducationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'school'     => 'required|string|max:255',
            'degree'     => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
        ];
    }
}
