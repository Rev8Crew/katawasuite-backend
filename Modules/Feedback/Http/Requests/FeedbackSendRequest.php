<?php

namespace Modules\Feedback\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackSendRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'text' => 'required|string',
            'user_id' => 'integer|nullable',
            'relation' => 'string|nullable',
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
