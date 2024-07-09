<?php

namespace App\Providers;

use App\Models\PendaftarOnline;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Menggunakan View Composer untuk mengikat data ke semua views
        View::composer('*', function ($view) {
            $profile = DB::table('tb_profile')->first();
            $view->with('profile', $profile);
            $notifications = PendaftarOnline::orderByDesc('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                ->where('no_induk', 'n')
                ->get();

            // Ambil data pendaftar yang tidak ada di tabel verifikasi
            $notificationsVerification = DB::table('tb_pendaftar')
                ->leftJoin('tb_pendaftar_verifikasi', 'tb_pendaftar.no_induk', '=', 'tb_pendaftar_verifikasi.no_induk')
                ->whereNull('tb_pendaftar_verifikasi.no_induk')
                ->orderByDesc('tb_pendaftar.id')
                ->select('tb_pendaftar.no_induk', 'tb_pendaftar.nm_lengkap', 'tb_pendaftar.gender', 'tb_pendaftar.no_hp')
                ->get();

            $user = Auth::user();
            $isSuperAdmin = false;

            // Cek apakah pengguna yang login adalah instance dari User
            if ($user instanceof User) {
                $isSuperAdmin = $user->isSuperAdmin();
            }

            $view->with([
                'notifications' => $notifications,
                'notificationsVerification' => $notificationsVerification,
                'isSuperAdmin' => $isSuperAdmin,
            ]);
        });
    }
}
