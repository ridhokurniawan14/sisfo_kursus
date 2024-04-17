<?php

namespace App\Http\Controllers;

use App\Models\PendaftarOnline;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftarOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pendaftaran.online.index', [
            "halaman" => "Data Pendaftar Online",
            "title" => "Pendaftar Online",
            "tab_title" => "Data Pendaftar",
            "datas" => DB::table('tb_ppdb')
                        ->orderByDesc('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                        ->get()
        ]);
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
    public function generatePDF(PendaftarOnline $pendaftarOnline)
    {
        $data = PendaftarOnline::findOrFail($pendaftarOnline->id);

        // Menggunakan options untuk mengatur konfigurasi DomPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $pdf = new Dompdf($options);

        // Konversi tampilan Blade ke HTML
        $html = view('dashboard.pendaftaran.online.pdf', ['data' => $data])->render();

        // Memuat HTML ke dalam objek DomPDF
        $pdf->loadHtml($html);

        // Render PDF
        $pdf->render();

        // Outputkan PDF sebagai respon HTTP
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf');
    }
    
    public function show(PendaftarOnline $pendaftarOnline)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendaftarOnline $pendaftarOnline)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PendaftarOnline $pendaftarOnline)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendaftarOnline $pendaftarOnline)
    {
        if ($pendaftarOnline->exists()) {
            $pendaftarOnline->delete();
            return redirect('pendaftar-online')->with('message', 'Data Berhasil Dihapus!');
        } else {
            return redirect('pendaftar-online')->with('error', 'Data Tidak Ditemukan!');
        }
    }
}
