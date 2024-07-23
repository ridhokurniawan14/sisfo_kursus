<?php

namespace App\Http\Controllers;

use App\Models\PendaftarOnline;
use Illuminate\Http\Request;

class DaftarOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('daftar-online.index', [
            "halaman" => "Pendaftaran Online",
            "judul" => "Pendaftaran Online"
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
        // Validasi data form
        $validatedData = $request->validate([
            'nm_lengkap' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'kewarganegaraan' => 'required|string|max:3',
            'status_pekerjaan' => 'required|string|max:50',
            'hobi' => 'nullable|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'pend_akhir' => 'required|string|max:50',
            'nm_ortu' => 'required|string|max:255',
            'pek_ortu' => 'required|string|max:50',
            'alamat_ortu' => 'required|string|max:255',
            'info_dari' => 'required|string|max:50',
        ]);

        // Tambahkan nilai default untuk no_induk dan tgl_daftar
        $validatedData['no_induk'] = 'n'; // default value
        $validatedData['tgl_daftar'] = now(); // current timestamp

        // Simpan data ke database
        PendaftarOnline::create($validatedData);

        // Redirect atau respon sesuai kebutuhan
        return back()->with('success', 'Pendaftaran berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(404);
    }
}
