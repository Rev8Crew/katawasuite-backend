<?php

namespace Modules\Authorization\Http\Requests;

use App\Http\Requests\CustomFormRequest;

class ResetPasswordRequest extends CustomFormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
