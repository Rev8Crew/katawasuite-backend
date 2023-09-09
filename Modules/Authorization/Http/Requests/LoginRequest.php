<?php

namespace Modules\Authorization\Http\Requests;

use App\Http\Requests\CustomFormRequest;
use App\Rules\ReCaptchaRule;

class LoginRequest extends CustomFormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
            'g-recaptcha-response' => ['required', new ReCaptchaRule],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
