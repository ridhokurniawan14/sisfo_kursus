<?php

namespace App\Http\Controllers;

use App\Models\ProgramPaket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KatalogController extends Controller
{
    public function paket()
    {
        $datas = DB::table('tb_paket_kursus as pk')
            ->join('tb_paket_kursus_pilihan as pkp', 'pk.id', '=', 'pkp.paket_kursus_id')
            ->join('tb_pilihan as p', 'pkp.pilihan_id', '=', 'p.id')
            ->select('pk.id', 'pk.kode', 'pk.harga', DB::raw('GROUP_CONCAT(p.program SEPARATOR ", ") as program_pilihan'))
            ->groupBy('pk.id', 'pk.kode', 'pk.harga')
            ->orderBy('pk.id')
            ->get();

        // Ambil program-program dari tabel tb_pilihan
        $programs = DB::table('tb_pilihan')->orderBy('id')->get();

        return view('daftar-online.katalog', compact('datas', 'programs'));
    }
}
