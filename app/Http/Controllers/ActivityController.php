<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index()
    {

        $datas = DB::table('activity_log as l')
            ->leftJoin('tb_pendidik as p', 'p.id', '=', 'l.causer_id')
            ->select('p.nm_lengkap', 'l.log_name', 'l.description', 'l.properties', 'l.created_at', 'l.causer_id')
            ->orderBy('l.created_at', 'desc');

        $activities = $datas->paginate(10);

        return view('Dashboard.logs.index', [
            "halaman" => "Log Activity",
            "title" => "Log",
            "tab_title" => "Activity",
            "activities" => $activities,
        ]);
    }
}
