<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

class LoginSiswaController extends Controller
{
    public function index()
    {
        return view('siswa.login.index', [
            "halaman" => "Login"
        ]);
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'no_induk' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('siswa')->attempt($credentials)) {
            $request->session()->regenerate();

            // Catat aktivitas login
            $user = Auth::guard('siswa')->user();
            $noInduk = $request->input('no_induk');

            activity()
                ->causedBy($user)
                ->tap(function (Activity $activity) use ($noInduk) {
                    $activity->log_name = 'Login';
                    $activity->subject_id = $noInduk; // Mengatur subject_id menjadi no_induk pengguna
                    $activity->subject_type = 'App\Models\Pendaftar'; // Mengatur subject_type sebagai nama kelas valid
                })
                ->withProperties([
                    'user_id' => $user->no_induk,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ])
                ->log('Success');

            $checkDataAngket = Pendaftar::leftJoin('tb_angket as a', 'tb_pendaftar.no_induk', '=', 'a.no_induk')
                ->leftJoin('tb_sertifikat as s', 'tb_pendaftar.no_induk', '=', 's.no_induk')
                ->leftJoin('tb_penilaian as p', 'tb_pendaftar.no_induk', '=', 'p.no_induk')
                ->where('tb_pendaftar.no_induk', $noInduk)
                ->first();

            if ($checkDataAngket->jawab1 == null) {
                return redirect()->route('kuesioner.index')->with('info', 'Mohon Mengisi Kuesioner ✏️');
            }
            return redirect()->intended('/siswa/dashboard')->with('info', 'Selamat Datang, Sehat Selalu 😊');
        }

        // Catat aktivitas login gagal
        $noInduk = $request->input('no_induk');

        activity()
            ->tap(function (Activity $activity) use ($noInduk) {
                $activity->log_name = 'Login';
                $activity->subject_id = $noInduk; // Mengatur subject_id menjadi no_induk dari input
                $activity->subject_type = 'App\Models\Pendaftar'; // Mengatur subject_type sebagai nama kelas valid
            })
            ->withProperties([
                'no_induk' => $request->input('no_induk'),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ])
            ->log('Login Failed');

        return redirect('/siswa/login')->with('error', 'No. Induk atau Password salah');
    }
    public function logout(Request $request)
    {
        Log::info('Logout method called');

        // Ambil pengguna yang terautentikasi
        $user = Auth::guard('siswa')->user();

        if ($user) {
            $userId = $user->id;
            Log::info('User is authenticated with ID: ' . $userId);

            // Cast $user to an instance of User model
            $userModel = Pendaftar::find($userId);

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

        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/siswa/login')->with('info', 'Logout Success');
    }
}
