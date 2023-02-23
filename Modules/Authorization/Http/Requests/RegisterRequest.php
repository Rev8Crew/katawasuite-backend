<?php

namespace Modules\Authorization\Http\Requests;

use App\Http\Requests\CustomFormRequest;

class RegisterRequest extends CustomFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:32',
            'password' => get_password_rules(),
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|unique:users|phone:RU,UA,KZ',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
