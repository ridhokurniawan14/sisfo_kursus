<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfTokenExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->tokenExpired($request)) {
            // Periksa guard yang digunakan (admin atau siswa) dan arahkan ke login yang sesuai
            if (Auth::guard('admin')->check()) {
                return redirect('/admin/login');
            } elseif (Auth::guard('siswa')->check()) {
                return redirect('/siswa/login');
            }
            // Jika tidak terautentikasi sebagai admin atau siswa, redirect ke login umum
            return redirect('/login');
        }

        return $next($request);
    }

    protected function tokenExpired($request)
    {
        // Implementasi logika untuk memeriksa apakah token sudah kadaluarsa
        return false;
    }
}
