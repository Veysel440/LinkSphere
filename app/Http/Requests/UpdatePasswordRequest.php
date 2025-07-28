<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password'      => 'required|string',
            'new_password'          => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'new_password.confirmed' => 'Yeni şifre doğrulaması eşleşmiyor.',
        ];
    }
}
