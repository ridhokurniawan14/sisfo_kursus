<?php

namespace App\Http\Controllers;

use App\Models\ProfilLembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilLembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profileExists = DB::table('tb_profile')->exists();

        if ($profileExists) {
            $firstProfile = ProfilLembaga::first();
            return redirect()->route('profil-lembaga.show', $firstProfile->id);
        } else {
            session()->flash('info', 'Tidak ada data profil lembaga yang tersedia.');
            return view('dashboard.data-master.profil-lembaga.index', [
                "halaman" => "Profil Lembaga",
                "title" => "Data Lembaga",
                "tab_title" => "Data Profil Lembaga",
            ]);
        }
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
        // Validasi input
        $request->validate([
            'nm_lembaga' => 'required',
            'npsn' => 'required',
            'bentuk' => 'required',
            'sts_lembaga' => 'required',
            'sts' => 'required',
            'sk_izin' => 'required',
            'sk_pendirian' => 'required',
            'tgl_sk_pendirian' => 'required|date',
            'tgl_sk_izin' => 'required|date',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kel' => 'required',
            'kec' => 'required',
            'kd_pos' => 'required',
            'kab' => 'required',
            'provinsi' => 'required',
            'no_tel' => 'required',
            'no_fax' => 'required',
            'email' => 'required|email',
            'web' => 'required',
            'but_kus' => 'required',
            'nm_yayasan' => 'required',
            'nm_pajak' => 'required',
            'no_npwp' => 'required',
            'nm_bank' => 'required',
            'bank_cabang' => 'required',
            'nm_rekening' => 'required',
            'luas_tanah' => 'required',
            'kat_lembaga' => 'required',
            'ms_ijin' => 'required',
            'sumber_dana' => 'required',
            'no_sertifikat' => 'required',
            'tgl_sertifikat' => 'required|date',
            'no_sk_akreditasi' => 'required',
            'mulai_berlaku' => 'required|date',
            'ms_akreditasi' => 'required',
            'hasil' => 'required',
            'penilai' => 'required',
            // Tambahkan validasi lainnya sesuai kebutuhan Anda
        ]);

        // Simpan data ke dalam database
        ProfilLembaga::create($request->all());

        // Redirect atau response sesuai kebutuhan aplikasi Anda
        return redirect('/profil-lembaga')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfilLembaga $profilLembaga)
    {
        return view('dashboard.data-master.profil-lembaga.show', [
            "halaman" => "Profil Lembaga",
            "title" => "Data Lembaga",
            "tab_title" => "Data Profil Lembaga",
            "data" => DB::table('tb_profile')
                        ->orderByDesc('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                        ->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfilLembaga $profilLembaga)
    {
        return view('dashboard.data-master.profil-lembaga.edit', [
            "halaman" => "Edit Profil Lembaga",
            "title" => "Data Lembaga",
            "tab_title" => "Edit Data Profil Lembaga",
            "cari" => $profilLembaga,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfilLembaga $profilLembaga)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nm_lembaga' => 'required',
            'npsn' => 'required',
            'bentuk' => 'required',
            'sts_lembaga' => 'required',
            'sts' => 'required',
            'sk_izin' => 'required',
            'sk_pendirian' => 'required',
            'tgl_sk_pendirian' => 'required|date',
            'tgl_sk_izin' => 'required|date',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kel' => 'required',
            'kec' => 'required',
            'kd_pos' => 'required',
            'kab' => 'required',
            'provinsi' => 'required',
            'no_tel' => 'required',
            'no_fax' => 'required',
            'email' => 'required|email',
            'web' => 'required',
            'but_kus' => 'required',
            'nm_yayasan' => 'required',
            'nm_pajak' => 'required',
            'no_npwp' => 'required',
            'nm_bank' => 'required',
            'bank_cabang' => 'required',
            'nm_rekening' => 'required',
            'luas_tanah' => 'required',
            'kat_lembaga' => 'required',
            'ms_ijin' => 'required',
            'sumber_dana' => 'required',
            'no_sertifikat' => 'required',
            'tgl_sertifikat' => 'required|date',
            'no_sk_akreditasi' => 'required',
            'mulai_berlaku' => 'required|date',
            'ms_akreditasi' => 'required',
            'hasil' => 'required',
            'penilai' => 'required',
            // Tambahkan validasi lainnya sesuai kebutuhan Anda
        ]);

        // Update data ke dalam database
        $profilLembaga->update($validatedData);

        // Redirect atau response sesuai kebutuhan aplikasi Anda
        if ($profilLembaga) {
            return redirect()->route('profil-lembaga.show', $profilLembaga->id)->with('message', 'Data berhasil diperbarui!');
        } else {
            return redirect()->route('profil-lembaga.index')->with('error', 'Gagal memperbarui data profil lembaga.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfilLembaga $profilLembaga)
    {
        abort(404);
    }
}
