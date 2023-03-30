<?php
declare(strict_types=1);

namespace Modules\Authorization\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }

    public function getCredentials(): array
    {
        return $this->only('email', 'password');
    }
}
