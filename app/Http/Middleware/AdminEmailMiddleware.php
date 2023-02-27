<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class AdminEmailMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->email, config('app.admin_emails'), true)) {
            abort(SymfonyResponse::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
