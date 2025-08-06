<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function authorize() { return auth()->check(); }
    public function rules()
    {
        return [
            'post_id'    => 'nullable|exists:posts,id',
            'comment_id' => 'nullable|exists:comments,id',
            'type'       => 'required|in:spam,abuse,illegal,other',
            'reason'     => 'required|string|max:500',
        ];
    }
}
