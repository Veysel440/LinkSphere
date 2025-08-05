<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserSkillRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'skill' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:5',
        ];
    }
}
