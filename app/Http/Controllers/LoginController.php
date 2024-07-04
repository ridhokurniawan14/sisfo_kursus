<?php

namespace App\Http\Controllers;

use App\Models\ProfilLembaga;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            "halaman" => "Login Admin"
        ]);
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            // Catat aktivitas login
            $userId = Auth::guard('admin')->id(); // Mengambil ID pengguna setelah login berhasil
            activity()
                ->causedBy(Auth::guard('admin')->user())
                ->tap(function (Activity $activity) {
                    $activity->log_name = 'Login';
                })
                ->withProperties([
                    'user_id' => $userId,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ])
                ->log('Success');

            $profileExists = ProfilLembaga::exists();
            if (empty($profileExists)) {
                return redirect()->route('profil-lembaga.index');
            }
            return redirect()->intended('/admin/dashboard')->with('info', 'Selamat Datang, Sehat Selalu 😊');
        }

        // Catat aktivitas login gagal
        activity()
            ->tap(function (Activity $activity) {
                $activity->log_name = 'Login';
            })
            ->withProperties([
                'email' => $request->input('email'),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ])
            ->log('Login Failed');

        return redirect('/admin/login')->with('error', 'Email atau Password salah');
    }

    public function logout(Request $request)
    {
        Log::info('Logout method called');

        // Ambil pengguna yang terautentikasi
        $user = Auth::guard('admin')->user();

        if ($user) {
            $userId = $user->id;
            Log::info('User is authenticated with ID: ' . $userId);

            // Cast $user to an instance of User model
            $userModel = User::find($userId);

            if ($userModel) {
                activity()
                    ->causedBy($userModel) // Gunakan instance model Eloquent pengguna sebagai penyebab
                    ->tap(function (Activity $activity) {
                        $activity->log_name = 'Logout'; // Atur nama log
                    })
                    ->log('Success');

                Log::info('Logout activity logged for user: ' . $userId);
            }
        } else {
            Log::info('User is not authenticated');
        }

        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login')->with('info', 'Logout Success');
    }
}
