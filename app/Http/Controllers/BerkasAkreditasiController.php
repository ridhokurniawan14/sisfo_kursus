<?php

namespace App\Http\Controllers;

use App\Models\BerkasAkreditasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BerkasAkreditasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-lembaga.berkas-pendukung-lembaga.index', [
            "halaman" => "Berkas Akreditasi",
            "title" => "Data Lembaga",
            "tab_title" => "Data Berkas Akreditasi",
            "datas" => DB::table('tb_berkas_akreditasi')
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
        $validatedData = $request->validate([
            'nm_fl' => ['required', 'file', 'mimes:pdf', 'max:10240'],
            'nm_brk' => ['required', 'string'],
            'thn' => ['required', 'integer'],
        ]);

        $validatedData['nm_fl'] = $request->file('nm_fl')->store('berkas-akreditasi', 'public');

        BerkasAkreditasi::create($validatedData);

        return redirect('/admin/berkas-akreditasi')->with('message', 'Data berhasil disimpan!');
    }
    /**
     * Display the specified resource.
     */
    public function show(BerkasAkreditasi $BerkasAkreditasi)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BerkasAkreditasi $BerkasAkreditasi)
    {
        return view('dashboard.data-lembaga.berkas-pendukung-lembaga.edit', [
            "halaman" => "Berkas Akreditasi",
            "title" => "Data Lembaga",
            "tab_title" => "Edit Berkas Akreditasi",
            "datas" => DB::table('tb_berkas_akreditasi')
                ->orderByDesc('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                ->get(),
            "cari" => $BerkasAkreditasi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BerkasAkreditasi $BerkasAkreditasi)
    {
        $request->validate([
            'nm_fl' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'nm_brk' => ['required', 'string'],
            'thn' => ['required', 'integer'],
        ]);

        $validatedData = [
            'nm_brk' => $request->nm_brk,
            'thn' => $request->thn,
        ];

        if ($request->hasFile('nm_fl')) {
            Storage::disk('public')->delete($BerkasAkreditasi->nm_fl);
            $validatedData['nm_fl'] = $request->file('nm_fl')->store('berkas-akreditasi', 'public');
        }

        $BerkasAkreditasi->update($validatedData);

        return redirect('/admin/berkas-akreditasi')->with('message', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BerkasAkreditasi $berkasAkreditasi)
    {
        // Periksa apakah berkas akreditasi ada
        if ($berkasAkreditasi) {
            // Hapus file terkait jika ada
            if (Storage::disk('public')->exists($berkasAkreditasi->nm_fl)) {
                Storage::disk('public')->delete($berkasAkreditasi->nm_fl);
            }

            // Hapus entri dari database
            $berkasAkreditasi->delete();

            // Redirect dengan pesan berhasil
            return redirect('/admin/berkas-akreditasi')->with('message', 'Data berhasil dihapus!');
        } else {
            // Redirect dengan pesan error jika berkas akreditasi tidak ditemukan
            return redirect('/admin/berkas-akreditasi')->with('error', 'Data tidak ditemukan!');
        }
    }
}
