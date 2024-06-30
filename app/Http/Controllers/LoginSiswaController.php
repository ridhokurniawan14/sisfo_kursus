<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginSiswaController extends Controller
{
    public function index()
    {
        return view('loginsiswa.index', [
            "halaman" => "Login"
        ]);
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('info', 'Selamat Datang, Sehat Selalu 😊');
        }
        return redirect('/login')->with('error', 'Email atau Password salah');
    }
    public function logout(Request $request): RedirectResponse
    {
        // Catat aktivitas logout sebelum logout dilakukan
        // ActivityLogger::logActivity('logout', Auth::user()->name);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
