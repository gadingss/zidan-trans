<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
    public function handle($request, Closure $next)
    {
        // Log untuk debugging
        logger('Middleware AuthenticateAdmin executed.');
        logger('Current session ID: ' . session()->getId());
        logger('Session data: ', session()->all());

        // Periksa apakah pengguna terautentikasi dan memiliki peran 'admin'
        $user = Auth::user();

        if (Auth::check() && $user->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, arahkan ke beranda dengan pesan kesalahan
        return redirect('/beranda')->with('error', 'Anda tidak memiliki akses admin.');
    }
}
