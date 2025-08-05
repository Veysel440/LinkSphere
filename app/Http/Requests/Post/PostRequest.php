<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()?->can('create', \App\Models\Post::class) ?? false;
    }

    public function rules()
    {
        return [
            'type'    => 'required|in:text,image,video,file',
            'content' => 'nullable|string|max:1000|not_regex:/<script.*?>.*?<\/script>/i',
            'media'   => 'nullable|array',
            'media.*' => 'string|max:2048',
            'tags'    => 'nullable|array',
            'tags.*'  => 'string|max:30',
        ];
    }

    public function messages()
    {
        return [
            'content.not_regex' => 'Gönderide geçersiz karakterler var.',
        ];
    }
}
