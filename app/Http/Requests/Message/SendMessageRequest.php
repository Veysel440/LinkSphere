<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    public function authorize()
    {
        return !$this->user()->is_banned;
    }

    public function rules()
    {
        return [
            'receiver_id' => 'required|exists:users,id|not_in:' . $this->user()->id,
            'content'     => 'required|string|max:1000|not_regex:/<script.*?>.*?<\/script>/i',
        ];
    }

    public function messages()
    {
        return [
            'content.not_regex' => 'Geçersiz karakterler var.',
            'receiver_id.not_in' => 'Kendinize mesaj atamazsınız.',
        ];
    }
}
