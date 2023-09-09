<?php

namespace Modules\Notification\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Notification\Models\Notification;

class ChangeSubscribeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|exists:' . Notification::TABLE. ',code',
            'status' => 'required|int|min:0|max:1'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
