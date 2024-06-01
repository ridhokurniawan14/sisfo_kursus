<?php

namespace App\Http\Controllers;

use App\Models\BiayaDaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BiayaDaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-master.biaya-pendaftaran.index', [
            "halaman" => "Setting Biaya Pendaftaran",
            "title" => "Data Master",
            "tab_title" => "Biaya Pendaftaran",
            "datas" => DB::table('tb_biaya_pendaftaran')
                        ->orderBy('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
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
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'biaya_daftar' => 'required|numeric',
        ]);

        // Buat dan simpan data ke dalam model
        $biayaPendaftaran = BiayaDaftar::create($validatedData);

        // Mengembalikan response JSON
        // return response()->json([
        //     'message' => 'Data berhasil disimpan',
        //     'data' => $biayaPendaftaran
        // ], 201);
        // Redirect dengan pesan sukses
        return redirect('/biaya-pendaftaran')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BiayaDaftar $biayaDaftar)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mencoba mengambil data dengan ID yang diberikan
        $biayaDaftar = DB::table('tb_biaya_pendaftaran')
                        ->where('id', $id)
                        ->orderBy('id')
                        ->first();

        // Debugging untuk memastikan data ditemukan
        // dd($id);
        return view('dashboard.data-master.biaya-pendaftaran.edit', [
            "halaman" => "Setting Biaya Pendaftaran",
            "title" => "Data Master",
            "tab_title" => "Biaya Pendaftaran",
            "datas" => DB::table('tb_biaya_pendaftaran')
                        ->orderBy('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                        ->get(),
            "cari" => $biayaDaftar,
        ]);        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BiayaDaftar $biayaDaftar)
    {
        // Aturan dasar validasi
        $rules = [
            'biaya_daftar' => ['required', 'numeric'], // Assuming 'biaya_daftar' should be numeric
        ];

        // Validasi tambahan jika 'biaya_daftar' diubah
        if ($request->biaya_daftar != $biayaDaftar->biaya_daftar) {
            $rules['biaya_daftar'][] = 'unique:tb_biaya_pendaftaran';
        }

        // Validasi data berdasarkan aturan yang telah dibuat
        $validateData = $request->validate($rules);
        
        // Perbarui data menggunakan instance model yang telah ditemukan
        $biayaDaftar->update($validateData);

        // Redirect dengan pesan sukses
        return redirect('/biaya-pendaftaran')->with('message', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BiayaDaftar $biayaDaftar)
    {
        abort(404);
    }
}
