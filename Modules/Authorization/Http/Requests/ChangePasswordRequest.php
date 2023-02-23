<?php

namespace Modules\Authorization\Http\Requests;

use App\Http\Requests\CustomFormRequest;

class ChangePasswordRequest extends CustomFormRequest
{
    public function rules()
    {
        return [
            'old' => 'required|string',
            'new_password' => get_password_rules(),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
