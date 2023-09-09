<?php

namespace Modules\User\Http\Requests;

use App\Http\Requests\CustomFormRequest;

class ChangePhoneRequest extends CustomFormRequest
{
    public function rules(): array
    {
        return [
            'phone' => 'required|unique:users|phone:RU,UA,KZ',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
