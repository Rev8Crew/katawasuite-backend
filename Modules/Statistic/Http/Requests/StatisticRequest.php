<?php

namespace Modules\Statistic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Statistic\Enums\StatisticOptionsEnum;

class StatisticRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'game_id' => 'integer|exists:games,id',
            'user_id' => 'nullable|integer',

            'option' => ['required', 'string', Rule::in(array_column(StatisticOptionsEnum::cases(), 'value'))],
            'value' => 'nullable',
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
