<?php

namespace App\Http\Requests\Like;

use Illuminate\Foundation\Http\FormRequest;

class LikeRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()?->can('like', \App\Models\Post::find($this->input('post_id'))) ?? false;
    }

    public function rules()
    {
        return [
            'post_id' => 'required|exists:posts,id'
        ];
    }
}
