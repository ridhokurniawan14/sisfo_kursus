<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Models\AngketPenilaian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AngketPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-lembaga.data-angket.penilaian-kinerja.index', [
            "halaman" => "Data Angket Penilaian Kinerja",
            "title" => "Data Lembaga",
            "tab_title" => "Data Angket Penilaian Kinerja",
            "datas" => DB::table('tb_penilaian as p')
                        ->select('p.*', 'pd.nm_lengkap',
                                DB::raw('ROUND((p.var1 + p.var2 + p.var3 + p.var4 + p.var5 + p.var6 + p.var7 + p.var8 + p.var9 + p.var10 + p.var11 + p.var12) / 12, 2) as rata_rata_var'),
                                DB::raw('ROUND((p.var1_tutor + p.var2_tutor + p.var3_tutor + p.var4_tutor + p.var5_tutor + p.var6_tutor + p.var7_tutor + p.var8_tutor + p.var9_tutor + p.var10_tutor + p.var11_tutor + p.var12_tutor + p.var13_tutor) / 13, 2) as rata_rata_var_tutor'))
                        ->join('tb_pendaftar as pd', 'p.no_induk', '=', 'pd.no_induk')
                        ->orderByDesc('p.id')
                        ->get(),        
        ]);
    }
    public function exportExcel($type)
    {
        $timestamp = now()->format('Ymd_His');
        $fileName = 'data-' . $type . '_' . $timestamp . '.xlsx';

        return Excel::download(new DataExport($type), $fileName);
    }
    public function exportPeserta($type)
    {
        $timestamp = now()->format('Ymd_His');
        $fileName = 'data-' . $type . '_' . $timestamp . '.xlsx';

        return Excel::download(new DataExport($type), $fileName);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(AngketPenilaian $angketPenilaian)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AngketPenilaian $angketPenilaian)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AngketPenilaian $angketPenilaian)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AngketPenilaian $angketPenilaian)
    {
        if ($angketPenilaian->exists()) {
            $angketPenilaian->delete();
            return redirect('angket-penilaian')->with('message', 'Data Berhasil Dihapus!');
        } else {
            return redirect('angket-penilaian')->with('error', 'Data Tidak Ditemukan!');
        }
    }
}
