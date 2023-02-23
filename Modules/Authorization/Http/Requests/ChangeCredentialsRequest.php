<?php

namespace Modules\Authorization\Http\Requests;

use App\Http\Requests\CustomFormRequest;

class ChangeCredentialsRequest extends CustomFormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'name' =>'required|string|min:3'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
