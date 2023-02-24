<?php

namespace Modules\Achievement\Http\Requests;

use App\Http\Requests\CustomFormRequest;

class CompleteByShortRequest extends CustomFormRequest
{
    public function rules(): array
    {
        return [
            'short' => 'required|string|exists:achievements,short',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
