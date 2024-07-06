<?php

namespace App\Http\Controllers;

use App\Models\AngketPenilaian;
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

        // $totalRegistrantsThisYear = array_sum($monthlyData['male']) + array_sum($monthlyData['female']);
        // $registrantsThisMonth = $monthlyData['male'][$currentMonth - 1] + $monthlyData['female'][$currentMonth - 1];

        // Mengambil data dari tb_pendaftar_verifikasi dan menghitung jumlah peserta untuk setiap program
        $programCounts = DB::table('tb_pendaftar_verifikasi')
            ->select('kd_pilihan1 as kd_pilihan')
            ->whereNotNull('kd_pilihan1')->where('kd_pilihan1', '!=', 0)
            ->unionAll(
                DB::table('tb_pendaftar_verifikasi')
                    ->select('kd_pilihan2 as kd_pilihan')
                    ->whereNotNull('kd_pilihan2')->where('kd_pilihan2', '!=', 0)
            )
            ->unionAll(
                DB::table('tb_pendaftar_verifikasi')
                    ->select('kd_pilihan3 as kd_pilihan')
                    ->whereNotNull('kd_pilihan3')->where('kd_pilihan3', '!=', 0)
            )
            ->unionAll(
                DB::table('tb_pendaftar_verifikasi')
                    ->select('kd_pilihan4 as kd_pilihan')
                    ->whereNotNull('kd_pilihan4')->where('kd_pilihan4', '!=', 0)
            )
            ->unionAll(
                DB::table('tb_pendaftar_verifikasi')
                    ->select('kd_pilihan5 as kd_pilihan')
                    ->whereNotNull('kd_pilihan5')->where('kd_pilihan5', '!=', 0)
            )
            ->unionAll(
                DB::table('tb_pendaftar_verifikasi')
                    ->select('kd_pilihan6 as kd_pilihan')
                    ->whereNotNull('kd_pilihan6')->where('kd_pilihan6', '!=', 0)
            )
            ->unionAll(
                DB::table('tb_pendaftar_verifikasi')
                    ->select('kd_tambahan as kd_pilihan')
                    ->whereNotNull('kd_tambahan')->where('kd_tambahan', '!=', 0)
            )
            ->unionAll(
                DB::table('tb_pendaftar_verifikasi')
                    ->select('kd_tambahan2 as kd_pilihan')
                    ->whereNotNull('kd_tambahan2')->where('kd_tambahan2', '!=', 0)
            )
            ->unionAll(
                DB::table('tb_pendaftar_verifikasi')
                    ->select('kd_tambahan3 as kd_pilihan')
                    ->whereNotNull('kd_tambahan3')->where('kd_tambahan3', '!=', 0)
            )
            ->unionAll(
                DB::table('tb_pendaftar_verifikasi')
                    ->select('kd_tambahan4 as kd_pilihan')
                    ->whereNotNull('kd_tambahan4')->where('kd_tambahan4', '!=', 0)
            )
            ->get()
            ->groupBy('kd_pilihan')
            ->map(function ($row) {
                return $row->count();
            });

        // Mengambil data program dari tb_pilihan dan mengurutkan berdasarkan jumlah peserta
        $popularPrograms = $programCounts->map(function ($count, $kd_pilihan) {
            $program = ProgramPilihan::find($kd_pilihan);
            return [
                'program' => $program ? $program->program : 'Unknown',
                'count' => $count
            ];
        })->sortByDesc('count')->values();

        $nullNewFormStudent = DB::table('tb_pendaftar as p')
            ->leftJoin('tb_angket as a', 'p.no_induk', '=', 'a.no_induk')
            ->orderByDesc('p.no_induk')
            ->whereNull('a.no_induk')
            ->take(5)
            ->select('p.no_induk', 'p.nm_lengkap', 'p.no_hp')
            ->get();

        $nullSurveyForm = DB::table('tb_pendaftar as p')
            ->leftJoin('tb_penilaian as tp', 'p.no_induk', '=', 'tp.no_induk')
            ->leftJoin('tb_sertifikat as s', 'p.no_induk', '=', 's.no_induk')
            ->where(function ($query) {
                $query->WhereNull('tp.no_induk');
            })
            ->whereNotNull('s.no_induk')
            ->orderBy('p.no_induk', 'desc')
            ->take(5)
            ->select('p.no_induk', 'p.nm_lengkap', 'p.no_hp')
            ->get();

        // Mengambil semua data dari tabel tb_penilaian
        $penilaians = AngketPenilaian::all();

        // Menghitung rata-rata nilai 'Tutor'
        $tutorAverage = $penilaians->avg(function ($penilaian) {
            return (
                $penilaian->var1_tutor + $penilaian->var2_tutor + $penilaian->var3_tutor +
                $penilaian->var4_tutor + $penilaian->var5_tutor + $penilaian->var6_tutor +
                $penilaian->var7_tutor + $penilaian->var8_tutor + $penilaian->var9_tutor +
                $penilaian->var10_tutor + $penilaian->var11_tutor + $penilaian->var12_tutor +
                $penilaian->var13_tutor
            ) / 13;
        });

        // Menghitung rata-rata nilai 'Administrasi'
        $administrasiAverage = $penilaians->avg(function ($penilaian) {
            return (
                $penilaian->var1 + $penilaian->var2 + $penilaian->var3 +
                $penilaian->var4 + $penilaian->var5 + $penilaian->var6 +
                $penilaian->var7 + $penilaian->var8 + $penilaian->var9 +
                $penilaian->var10 + $penilaian->var11 + $penilaian->var12
            ) / 12;
        });

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
            'nullSurveyForms' => $nullSurveyForm,
            "countUser" => User::count(),
            "countProgramPilihan" => ProgramPilihan::count(),
            "countProgramPaket" => ProgramPaket::count(),
            "popularProgramLabels" => $programLabels,
            "popularProgramData" => $programData,
            "registrantsData" => $allRegistrants,
            "popularPrograms" => $popularPrograms,
            "tutorAverage" => $tutorAverage,
            "administrasiAverage" => $administrasiAverage,
        ]);
    }
    private function getStarRating($average)
    {
        $fullStars = floor($average);
        $halfStar = ($average - $fullStars) >= 0.5 ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStar;

        return compact('fullStars', 'halfStar', 'emptyStars');
    }
}
