<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index()
    {
        // Log untuk admin berdasarkan causer_id dan causer_type
        $adminLogs = DB::table('activity_log as l')
            ->leftJoin('tb_pendidik as p', function ($join) {
                $join->on('p.id', '=', 'l.causer_id')
                    ->where('l.causer_type', '=', 'App\Models\User');
            })
            ->select('p.nm_lengkap as nm_lengkap', 'l.log_name', 'l.description', 'l.properties', 'l.created_at', 'l.causer_id', 'l.subject_id', 'l.subject_type')
            ->where('l.causer_type', '=', 'App\Models\User');

        // Log untuk siswa berdasarkan causer_id atau subject_id jika subject_type adalah no_induk
        $pendaftarLogs = DB::table('activity_log as l')
            ->leftJoin('tb_pendaftar as tp_causer', function ($join) {
                $join->on('tp_causer.id', '=', 'l.causer_id')
                    ->where('l.causer_type', '=', 'App\Models\Pendaftar');
            })
            ->leftJoin('tb_pendaftar as tp_subject', function ($join) {
                $join->on('tp_subject.no_induk', '=', 'l.subject_id')
                    ->where('l.subject_type', '=', 'no_induk');
            })
            ->select(DB::raw('COALESCE(tp_causer.nm_lengkap, tp_subject.nm_lengkap, "Unknown") as nm_lengkap'), 'l.log_name', 'l.description', 'l.properties', 'l.created_at', 'l.causer_id', 'l.subject_id', 'l.subject_type')
            ->where(function ($query) {
                $query->where('l.causer_type', '=', 'App\Models\Pendaftar')
                    ->orWhere(function ($subQuery) {
                        $subQuery->where('l.subject_type', '=', 'no_induk')
                            ->whereNotNull('l.subject_id');
                    });
            });

        // Log untuk Unknown (causer_type = null)
        $unknownLogs = DB::table('activity_log as l')
            ->select(DB::raw('"Unknown" as nm_lengkap'), 'l.log_name', 'l.description', 'l.properties', 'l.created_at', 'l.causer_id', 'l.subject_id', 'l.subject_type')
            ->whereNull('l.causer_type')
            ->whereNull('l.subject_type');

        // Gabungkan ketiga query
        $datas = $adminLogs->union($pendaftarLogs)->union($unknownLogs)->orderBy('created_at', 'desc');

        // Paginate hasilnya
        $activities = $datas->paginate(10);

        return view('Dashboard.logs.index', [
            "halaman" => "Log Activity",
            "title" => "Log",
            "tab_title" => "Activity",
            "activities" => $activities,
        ]);
    }
}
