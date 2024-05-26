<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pendaftaran.offline.index', [
            "halaman" => "Data Pendaftar",
            "title" => "Pendaftar",
            "tab_title" => "Data Pendaftar",
            "datas" => DB::table('tb_pendaftar')
                        ->join('tb_pendaftar_verifikasi', 'tb_pendaftar.no_induk', '=', 'tb_pendaftar_verifikasi.no_induk')
                        ->orderByDesc('tb_pendaftar.id')
                        ->select('tb_pendaftar.no_induk','nm_lengkap','gender','tb_pendaftar_verifikasi.pil_prog','tb_pendaftar_verifikasi.biaya_kursus','tb_pendaftar_verifikasi.kekurangan','no_hp') // Pilih kolom yang ingin Anda ambil
                        ->paginate(10)
                        // ->get()
        ]);
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
