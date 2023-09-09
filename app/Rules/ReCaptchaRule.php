<?php

namespace App\Rules;

use Closure;
use Http;
use Illuminate\Contracts\Validation\ValidationRule;

class ReCaptchaRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $secret = config('auth.recaptcha.secret');

        if ($secret) {
            $response = Http::get('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('auth.recaptcha.secret'),
                'response' => $value,
            ]);

            if (! $response || ! $response->json()['success']) {
                $fail('validation.recaptcha')->translate();
            }
        }
    }
}
