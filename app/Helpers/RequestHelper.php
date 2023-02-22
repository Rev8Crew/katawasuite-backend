<?php

namespace App\Helpers;

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class RequestHelper
{
    public static function isFromFrontend($request): bool
    {
        return EnsureFrontendRequestsAreStateful::fromFrontend($request);
    }
}
