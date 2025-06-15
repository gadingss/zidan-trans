<?php
namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        // Prioritaskan URL yang diminta sebelumnya
        $redirectUrl = redirect()->intended()->getTargetUrl();

        // Jika admin, tetap arahkan ke /admin
        if ($user->email === 'gading@example.com') {
            return redirect('/admin');
        }

        // Selain itu, arahkan ke URL yang diminta atau ke beranda
        return $redirectUrl !== url('/') ? redirect($redirectUrl) : redirect()->route('beranda');
    }
}


