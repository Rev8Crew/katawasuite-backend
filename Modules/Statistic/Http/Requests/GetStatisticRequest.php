<?php

namespace Modules\Statistic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetStatisticRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'game_id' => 'integer|exists:games,id',
            'user_id' => 'nullable|integer',
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
