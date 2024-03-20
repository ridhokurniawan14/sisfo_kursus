<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-master.pengumuman.index', [
            "halaman" => "Pengumuman",
            "title" => "Data Lembaga",
            "tab_title" => "Data Pengumuman",
            "datas" => DB::table('tb_pengumuman')
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
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'jenis' => ['required'],
            'judul' => ['required', 'unique:tb_pengumuman'],
            'ket'   => ['required'],
            'untuk' => ['required'],
            'foto'  => ['mimes:jpeg,jpg,png,webp', 'max:5120'], // max:5120 artinya maksimum 2MB (5120 KB)
        ]);

        // Set nilai 'created_by' sesudah validasi
        $validatedData['created_by'] = auth()->user()->nm_lengkap;

        // Jika ada file foto yang diunggah, simpan dan atur path-nya
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('pengumuman', 'public');
        }

        // Menyimpan data ke dalam database dan langsung mendapatkan objek Pengumuman yang dibuat
        $pengumuman = Pengumuman::create($validatedData);

        // Redirect ke halaman '/pengumuman' dengan pesan sukses
        return redirect('/pengumuman')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('dashboard.data-master.pengumuman.edit', [
            "halaman" => "Edit Pengumuman",
            "title" => "Data Lembaga",
            "tab_title" => "Data Pengumuman",
            "datas" => DB::table('tb_pengumuman')
                        ->orderByDesc('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                        ->get(),
            "cari" => $pengumuman,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'jenis' => ['required'],
            'judul' => ['required', Rule::unique('tb_pengumuman')->ignore($pengumuman->id)],
            'ket'   => ['required'],
            'untuk' => ['required'],
            'foto'  => ['nullable', 'mimes:jpeg,jpg,png,webp', 'max:5120'], // Menjadikan foto opsional dengan menambahkan nullable
        ]);

        // Set nilai 'created_by' sesudah validasi
        $validatedData['created_by'] = auth()->user()->nm_lengkap;

        // Jika ada file foto yang diunggah, simpan dan atur path-nya
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pengumuman->foto) {
                Storage::disk('public')->delete($pengumuman->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('pengumuman', 'public');
        }

        // Update data ke dalam database
        $pengumuman->update($validatedData);

        // Redirect ke halaman '/pengumuman' dengan pesan sukses
        return redirect('/pengumuman')->with('message', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        // Periksa apakah pengguna ada
        if($pengumuman) {
            // Hapus foto jika ada
            if ($pengumuman->foto) {
                // Menghapus foto dari storage
                Storage::delete('public/' . $pengumuman->foto);
            }
            
            // Hapus pengguna
            $pengumuman->delete();

            // Redirect dengan pesan berhasil
            return redirect('/pengumuman')->with('message', 'Data Berhasil Dihapus!');
        } else {
            // Redirect dengan pesan error jika pengguna tidak ditemukan
            return redirect('/pengumuman')->with('error', 'Data tidak ditemukan!');
        }
    }
}
