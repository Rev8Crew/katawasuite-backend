<?php

namespace Modules\Ladder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetYearRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'year' => 'int|min:2022'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
