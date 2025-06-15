<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (!Auth::check()) {
            logger('User is not authenticated. Redirecting to login.');
            return redirect()->route('login'); // Arahkan ke halaman login jika tidak login
        }

        return $next($request);
    }
}
