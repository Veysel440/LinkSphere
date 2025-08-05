<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize()
    {
        $postId = $this->route('postId') ?? $this->input('post_id');
        return $postId ? $this->user()->can('comment', \App\Models\Post::find($postId)) : true;
    }

    public function rules()
    {
        return [
            'content' => [
                'required',
                'string',
                'max:500',
                'not_regex:/<script.*?>.*?<\/script>/i',
            ],
        ];
    }

    public function messages()
    {
        return [
            'content.not_regex' => 'Yorumda geçersiz karakterler var.',
        ];
    }
}
