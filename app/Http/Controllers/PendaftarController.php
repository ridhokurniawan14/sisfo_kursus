<?php

namespace App\Http\Controllers;

use App\Exports\DataPendaftarExport;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('tb_pendaftar')
                        ->join('tb_pendaftar_verifikasi', 'tb_pendaftar.no_induk', '=', 'tb_pendaftar_verifikasi.no_induk')
                        ->orderByDesc('tb_pendaftar.id')
                        ->select('tb_pendaftar.no_induk','nm_lengkap','gender','tb_pendaftar_verifikasi.pil_prog','tb_pendaftar_verifikasi.biaya_kursus','tb_pendaftar_verifikasi.kekurangan','no_hp'); // Pilih kolom yang ingin Anda ambil

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('tb_pendaftar.no_induk', 'like', "%{$search}%")
                ->orWhere('tb_pendaftar.nm_lengkap', 'like', "%{$search}%");
            });
        }

        $datas = $query->paginate(10);

        return view('dashboard.pendaftaran.offline.index', [
            "halaman" => "Data Pendaftar Online",
            "title" => "Pendaftar Online",
            "tab_title" => "Data Pendaftar",
            "datas" => $datas
        ]);
    }
    public function export()
    {
        return Excel::download(new DataPendaftarExport, 'data_pendaftar.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftar $pendaftar)
    {
        //
    }
}
