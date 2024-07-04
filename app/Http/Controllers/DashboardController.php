<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\ProgramPaket;
use App\Models\ProgramPilihan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;
        $years = [$currentYear, $currentYear - 1, $currentYear - 2, $currentYear - 3, $currentYear - 4];
        $currentMonth = Carbon::now()->month;
        $allRegistrants = [];

        foreach ($years as $year) {
            $registrants = DB::table('tb_pendaftar')
                ->selectRaw('MONTH(tgl_masuk) as month, LOWER(gender) as gender, COUNT(*) as count')
                ->whereYear('tgl_masuk', $year)
                ->groupBy('month', 'gender')
                ->get();

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

            $allRegistrants[$year] = $monthlyData;
        }

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
            $programLabels[] = 'P.' . $program->kd_paket . ' (' . $program->total . ' Peserta)';
            $programData[] = $program->total;
        }

        $totalRegistrantsThisYear = array_sum($monthlyData['male']) + array_sum($monthlyData['female']);
        $registrantsThisMonth = $monthlyData['male'][$currentMonth - 1] + $monthlyData['female'][$currentMonth - 1];

        $nullNewFormStudent = DB::table('tb_pendaftar as p')
            ->leftJoin('tb_angket as a', 'p.no_induk', '=', 'a.no_induk')
            ->orderByDesc('p.no_induk')
            ->whereNull('a.no_induk')
            ->take(5)
            ->select('p.no_induk', 'p.nm_lengkap', 'p.no_hp')
            ->get();

        // $nullNewFormStudent = $nullNewForm->paginate(5);

        return view('dashboard.index', [
            "halaman" => "Dashboard",
            "title" => "Dashboard",
            "tab_title" => "Dashboard",
            "countStudent" => Pendaftar::count(),
            'newStudent' => Pendaftar::join('tb_pendaftar_verifikasi', 'tb_pendaftar.no_induk', '=', 'tb_pendaftar_verifikasi.no_induk')
                ->orderBy('tb_pendaftar.no_induk', 'desc')
                ->take(5)
                ->get(),
            'nullNewFormStudent' => $nullNewFormStudent,
            "countUser" => User::count(),
            "countProgramPilihan" => ProgramPilihan::count(),
            "countProgramPaket" => ProgramPaket::count(),
            "popularProgramLabels" => $programLabels,
            "popularProgramData" => $programData,
            "registrantsData" => $allRegistrants,
        ]);
    }
}
