<?php

namespace App\Http\Controllers;

use App\Models\BiayaDaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
                        ->get(),
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
            'biaya_daftar' => 'required',
        ]);

        // Menghapus tanda titik dari harga sebelum disimpan
        $validatedData['biaya_daftar'] = str_replace('.', '', $validatedData['biaya_daftar']);

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

    // Method untuk menampilkan form edit
    public function edit($id)
    {
        $cari = BiayaDaftar::findOrFail($id);
        $datas = DB::table('tb_biaya_pendaftaran')
                    ->orderBy('id')
                    ->get();

        return view('dashboard.data-master.biaya-pendaftaran.edit', [
            'halaman' => 'Edit Biaya Pendaftaran',
            'title' => 'Data Master',
            'tab_title' => 'Edit Biaya Pendaftaran',
            'datas' => $datas,
            'cari' => $cari,
        ]);
    }

    // Method untuk mengupdate data
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'biaya_daftar' => 'required',
        ]);

         // Menghapus tanda titik dari harga sebelum disimpan
        $validatedData['biaya_daftar'] = str_replace(['.', ','], '', $validatedData['biaya_daftar']);

        // Mencari data berdasarkan ID
        $biayaDaftar = BiayaDaftar::findOrFail($id);
        
        // Mengupdate data
        $biayaDaftar->update([
            'biaya_daftar' => $validatedData['biaya_daftar'],
            'active' => $request->has('active') ? 1 : 0,
        ]);

        // Redirect setelah update
        return redirect('/biaya-pendaftaran')->with('message', 'Data berhasil disimpan!');
        // return redirect()->route('biaya-pendaftaran.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BiayaDaftar $biayaDaftar)
    {
        abort(404);
    }
}
