<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminEmailMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || in_array($user->email, config('app.admin_emails'), true)) {
            abort(403);
        }

        return $next($request);
    }
}
