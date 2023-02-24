<?php

namespace App\Http\Requests;

use App\Models\Common\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CustomFormRequest extends FormRequest
{
    /**
     * @return Response|void
     */
    protected function failedValidation(Validator $validator)
    {
        $response = Response::make();
        throw (new ValidationException($validator, \response($response->validation($validator)->toArray())))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
