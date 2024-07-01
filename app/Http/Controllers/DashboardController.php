<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\ProgramPaket;
use App\Models\ProgramPilihan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $registrants = DB::table('tb_pendaftar')
            ->selectRaw('MONTH(tgl_masuk) as month, LOWER(gender) as gender, COUNT(*) as count')
            ->whereYear('tgl_masuk', $currentYear)
            ->groupBy('month', 'gender')
            ->get();

        // Query untuk mengambil jumlah pendaftar berdasarkan program paket
        $popularPrograms = DB::table('tb_pendaftar_verifikasi')
            ->select('kd_paket', DB::raw('COUNT(*) as total'))
            ->whereRaw('LOWER(pil_prog) = ?', ['paket'])
            ->groupBy('kd_paket')
            ->orderByDesc('total')
            ->get();

        $programLabels = [];
        $programData = [];

        foreach ($popularPrograms as $program) {
            $programLabels[] = 'P ' . $program->kd_paket . ' (' . $program->total . ' Peserta)';
            $programData[] = $program->total;
        }

        $monthlyData = [
            'male' => array_fill(0, 12, 0),
            'female' => array_fill(0, 12, 0),
        ];

        foreach ($registrants as $registrant) {
            $monthIndex = $registrant->month - 1;
            if ($registrant->gender == 'l') {
                $monthlyData['male'][$monthIndex] = $registrant->count;
            } else if ($registrant->gender == 'p') {
                $monthlyData['female'][$monthIndex] = $registrant->count;
            }
        }

        $totalRegistrantsThisYear = array_sum($monthlyData['male']) + array_sum($monthlyData['female']);
        $registrantsThisMonth = $monthlyData['male'][$currentMonth - 1] + $monthlyData['female'][$currentMonth - 1];

        return view('dashboard.index', [
            "halaman" => "Dashboard",
            "title" => "Dashboard",
            "tab_title" => "Dashboard",
            "countStudent" => Pendaftar::count(),
            "countUser" => User::count(),
            "countProgramPilihan" => ProgramPilihan::count(),
            "countProgramPaket" => ProgramPaket::count(),
            "countStudentThisYear" => $totalRegistrantsThisYear,
            "registrantsThisMonth" => $registrantsThisMonth,
            "monthlyData" => $monthlyData,
            "popularProgramLabels" => $programLabels,
            "popularProgramData" => $programData,
        ]);
    }
}
