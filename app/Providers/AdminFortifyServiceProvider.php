<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;

class AdminFortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Fortify::authenticateUsing(function (Request $request) {
            $credentials = $request->only('email', 'password');

            // Coba login dengan guard admin
            if (Auth::guard('admin')->attempt($credentials)) {
                $user = Auth::guard('admin')->user();

                // Cek role admin (sesuaikan dengan kolom role di tabel users)
                if ($user->role === 'admin') {
                    return $user;
                }

                Auth::guard('admin')->logout();
            }

            return null;
        });

        Fortify::loginView(function () {
            return view('admin.auth.login'); // view login admin (buat sendiri)
        });

        // Fortify::logout(function (Request $request) {
        //     Auth::guard('admin')->logout();
        //     $request->session()->invalidate();
        //     $request->session()->regenerateToken();
        //     return redirect('/admin/login');
        // });
    }
}
