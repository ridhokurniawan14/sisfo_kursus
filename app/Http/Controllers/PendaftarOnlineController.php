<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\PendaftarOnline;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\RedirectResponse;
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

                ->where('status', 'unpaid') // Tambahkan filter unpaid
                ->orderByDesc('id')
                ->get()
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $pendaftar_online = PendaftarOnline::where('id', $id)->firstOrFail();
        // Mendapatkan NIS terakhir dari tabel pendaftar
        $lastStudent = DB::table('tb_pendaftar')->orderBy('no_induk', 'desc')->first();
        $lastNIS = $lastStudent ? $lastStudent->no_induk : 0;
        $newNIS = $lastNIS + 1;

        $data = [
            "halaman" => "Verifikasi Peserta Didik",
            "title" => "Pendaftaran",
            "tab_title" => "Verifikasi Peserta Didik",
            "pendaftar_online" => $pendaftar_online,
            "newNIS" => $newNIS,
            "id" => $id,
        ];
        return view('dashboard.pendaftaran.online.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id): RedirectResponse
    {

        // Validasi data input
        $validatedData = $request->validate([
            'no_induk' => 'required|unique:tb_pendaftar,no_induk',
            'nm_lengkap' => 'required|string|max:255',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'gender' => 'required|string|max:1',
            'nisn' => 'nullable',
            'nik' => 'nullable',
            'agama' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:255',
            'pend_akhir' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable',
            'status_pekerjaan' => 'required|string|max:255',
            'tgl_masuk' => 'required|date',
            'alamat' => 'required|string|max:255',
            'rt' => 'nullable',
            'rw' => 'nullable',
            'kel' => 'nullable|string|max:255',
            'kec' => 'nullable|string|max:255',
            'kd_pos' => 'nullable',
            'kab' => 'required|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'jns_tinggal' => 'nullable|string|max:255',
            'nm_ayah' => 'nullable|string|max:255',
            'nik_ayah' => 'nullable',
            'tgl_ayah' => 'nullable|date',
            'pend_ayah' => 'nullable|string|max:255',
            'pek_ayah' => 'nullable|string|max:255',
            'nm_ibu' => 'nullable|string|max:255',
            'nik_ibu' => 'nullable',
            'tgl_ibu' => 'nullable|date',
            'pend_ibu' => 'nullable|string|max:255',
            'pek_ibu' => 'nullable|string|max:255',
            'alamat_ortu' => 'nullable|string|max:255',
            'hp_ortu' => 'nullable',
            'telepon_ortu' => 'nullable',
            'anak_ke' => 'nullable',
            'nm_wali' => 'nullable|string|max:255',
            'nik_wali' => 'nullable',
            'tgl_wali' => 'nullable|date',
            'pend_wali' => 'nullable|string|max:255',
            'pek_wali' => 'nullable|string|max:255',
            'alamat_wali' => 'nullable|string|max:255',
            'hp_wali' => 'nullable',
        ]);

        // Tambahkan password yang sama dengan tanggal lahir, dalam format hashed
        $validatedData['password'] = bcrypt($request->tgl_lahir);

        // Set all empty values to null
        foreach ($validatedData as $key => $value) {
            if (empty($value) || $value === 'null') {
                $validatedData[$key] = null;
            }
        }

        // Simpan data ke database Pendaftar
        $pendaftar = Pendaftar::create($validatedData);

        // Update no_induk di database PendaftarOnline berdasarkan id
        $po = PendaftarOnline::where('id', $id)->update(['no_induk' => $validatedData['no_induk']]);

        // Redirect ke halaman verifikasi
        return redirect()->route('pendaftaran.verifikasi', ['no_induk' => $pendaftar->no_induk])
            ->with('message', 'Data pendaftar berhasil disimpan. Silahkan Verifikasi');
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
            return redirect('/admin/pendaftar-online')->with('message', 'Data Berhasil Dihapus!');
        } else {
            return redirect('/admin/pendaftar-online')->with('error', 'Data Tidak Ditemukan!');
        }
    }
}
