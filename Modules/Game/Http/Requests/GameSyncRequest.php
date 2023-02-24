<?php

namespace Modules\Game\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameSyncRequest extends FormRequest
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
