<?php

use Illuminate\Validation\Rules\Password;

function uncache($url)
{
    $url = '/'.$url;
    $url = str_replace('//', '/', $url);
    $full_path = public_path().$url;

    $pref = 'not_found';
    if (file_exists($full_path)) {
        $pref = filemtime($full_path);
    }

    return $url.'?'.$pref;
}

/**
 * Общие правила для пароля
 */
function get_password_rules(): array
{
    return ['required', 'confirmed', Password::min(6)->letters()->numbers()];
}

function default_title_prefix($title): string
{
    return 'Katawa Suite | '.$title;
}

/**
 * @throws JsonException
 */
function decode_jwt_token(string $token): array
{
    $tokenParts = explode('.', $token);
    $tokenHeader = base64_decode($tokenParts[0]);
    $tokenPayload = base64_decode($tokenParts[1]);
    $jwtHeader = json_decode($tokenHeader, true, 512, JSON_THROW_ON_ERROR);

    return json_decode($tokenPayload, true, 512, JSON_THROW_ON_ERROR);
}
