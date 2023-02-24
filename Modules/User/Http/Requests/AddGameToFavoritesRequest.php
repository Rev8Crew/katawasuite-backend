<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddGameToFavoritesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:games',
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
