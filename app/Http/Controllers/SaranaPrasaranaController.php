<?php

namespace App\Http\Controllers;

use App\Models\SaranaPrasarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaranaPrasaranaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-master.sarana-prasarana.index', [
            "halaman" => "Sarana Prasarana",
            "title" => "Data Lembaga",
            "tab_title" => "Data Sarana Prasarana",
            "datas" => DB::table('tb_sarpras')
                ->orderBy('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.data-master.sarana-prasarana.create', [
            "halaman" => "Sarana Prasarana",
            "title" => "Data Master",
            "tab_title" => "Tambah Sarana Prasarana",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'jenis' => ['required'],
            'status' => ['required'],
            'nm_sarpras' => ['required', 'unique:tb_sarpras'],
            'banyak' => ['required', 'numeric'],
            'ket' => ['nullable'],
        ]);

        // Menyimpan data ke dalam database tanpa mengonversi huruf kecil secara eksplisit
        SaranaPrasarana::create($validatedData);

        return redirect('/admin/sarana-prasarana')->with('message', 'Data berhasil disimpan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(SaranaPrasarana $saranaPrasarana)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaranaPrasarana $saranaPrasarana)
    {
        return view('dashboard.data-master.sarana-prasarana.edit', [
            "halaman" => "Sarana Prasarana",
            "title" => "Data Master",
            "tab_title" => "Edit Sarana Prasarana",
            "cari" => $saranaPrasarana,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaranaPrasarana $saranaPrasarana)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'jenis' => ['required'],
            'status' => ['required'],
            'nm_sarpras' => ['required', 'unique:tb_sarpras,nm_sarpras,' . $saranaPrasarana->id],
            'banyak' => ['required', 'numeric'],
            'ket' => ['nullable'],
        ]);

        // Mengisi instance model dengan data yang divalidasi
        $saranaPrasarana->fill($validatedData);

        // Menyimpan perubahan ke dalam database
        $saranaPrasarana->save();

        return redirect('/admin/sarana-prasarana')->with('message', 'Data berhasil Diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaranaPrasarana $saranaPrasarana)
    {
        if ($saranaPrasarana->exists()) {
            $saranaPrasarana->delete();
            return redirect('/admin/sarana-prasarana')->with('message', 'Data Berhasil Dihapus!');
        } else {
            return redirect('/admin/sarana-prasarana')->with('error', 'Data Tidak Ditemukan!');
        }
    }
}
