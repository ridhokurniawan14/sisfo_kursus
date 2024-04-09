<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Models\AngketPesertaDidikBaru;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AngketPesertaDidikBaruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-lembaga.data-angket.peserta-didik-baru.index', [
            "halaman" => "Data Angket Peserta Didik Baru",
            "title" => "Data Lembaga",
            "tab_title" => "Data Angket Peserta Didik Baru",
            "datas" => DB::table('tb_angket')
                        ->orderByDesc('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                        ->get()
        ]);
    }
    public function exportExcel()
    {
        $timestamp = Carbon::now()->format('Ymd_His');
        $fileName = 'data-angket-peserta-didik-baru_' . $timestamp . '.xlsx';

        return Excel::download(new DataExport, $fileName);
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
    public function show(AngketPesertaDidikBaru $angketPesertaDidikBaru)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AngketPesertaDidikBaru $angketPesertaDidikBaru)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AngketPesertaDidikBaru $angketPesertaDidikBaru)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AngketPesertaDidikBaru $angketPesertaDidikBaru)
    {
        if ($angketPesertaDidikBaru->exists()) {
            $angketPesertaDidikBaru->delete();
            return redirect('angket-peserta-didik-baru')->with('message', 'Data Berhasil Dihapus!');
        } else {
            return redirect('angket-peserta-didik-baru')->with('error', 'Data Tidak Ditemukan!');
        }
    }
}
