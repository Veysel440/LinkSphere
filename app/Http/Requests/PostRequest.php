<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type'    => 'required|in:text,image,video,file',
            'content' => 'nullable|string|max:1000',
            'media'   => 'nullable|array',
            'media.*' => 'string',
            'tags'    => 'nullable|array',
            'tags.*'  => 'string',
        ];
    }
}
