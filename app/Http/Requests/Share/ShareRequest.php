<?php

namespace App\Http\Requests\Share;

use Illuminate\Foundation\Http\FormRequest;

class ShareRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()?->can('share', \App\Models\Post::find($this->input('post_id'))) ?? false;
    }

    public function rules()
    {
        return [
            'post_id' => 'required|exists:posts,id'
        ];
    }
}
