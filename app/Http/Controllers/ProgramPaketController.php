<?php

namespace App\Http\Controllers;

use App\Models\ProgramPaket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProgramPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-master.program-paket.index', [
            "halaman" => "Program Paket",
            "title" => "Data Master",
            "tab_title" => "Data Program Paket",
            "datas" => DB::table('tb_paket_kursus')
                        ->orderBy('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                        ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode'  => ['required', 'numeric', 'unique:tb_paket_kursus'],
            'program_pilihan'  => ['required', 'unique:tb_paket_kursus'],
            'harga'  => ['required'],
        ]);
        
        // Mengonversi 'program' menjadi huruf kecil sebelum disimpan
        // $validateData['kode'] = $validateData['kode'];

        // Mengonversi 'program' menjadi huruf kecil sebelum disimpan
        $validateData['program_pilihan'] = strtolower($validateData['program_pilihan']);

        // Menghapus tanda titik dari harga sebelum disimpan
        $validateData['harga'] = str_replace('.', '', $request->harga);

        ProgramPaket::create($validateData);

        // Catat aktivitas dalam log
        // ActivityLogger::logActivity('create', 'Kategori Kode Surat Masuk dengan deskripsi '.ucwords($request->ket), '');

        return redirect('/program-paket')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramPaket $programPaket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramPaket $programPaket)
    {
        return view('dashboard.data-master.program-paket.edit', [
            "halaman" => "Program Paket",
            "title" => "Data Master",
            "tab_title" => "Data Program Paket",
            "datas" => DB::table('tb_paket_kursus')
                        ->orderBy('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                        ->get(),
            "cari" => $programPaket,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramPaket $programPaket)
    {
        $validateData = $request->validate([
            'kode' => ['required', 'numeric', Rule::unique('tb_paket_kursus')->ignore($programPaket->id)],
            'program_pilihan'  => ['required'],
            'harga'  => ['required'],
        ]);
        
        // Mengonversi 'program' menjadi huruf kecil sebelum disimpan
        $validateData['program_pilihan'] = strtolower($validateData['program_pilihan']);

        // Menghapus tanda titik dari harga sebelum disimpan
        $validateData['harga'] = str_replace('.', '', $request->harga);

        // Simpan data jika validasi berhasil
        $programPaket->update($validateData);

        // Catat aktivitas dalam log
        // ActivityLogger::logActivity('create', 'Kategori Kode Surat Masuk dengan deskripsi '.ucwords($request->ket), '');
        return redirect('/program-paket')->with('message', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramPaket $programPaket)
    {
        if($programPaket) {
            $programPaket->delete();
            // Catat aktivitas dalam log
            // ActivityLogger::logActivity('delete', 'Kode Surat Masuk dengan kode '.ucwords($jam->kode).' -> '.ucwords($jam->ket), '');

            return redirect('program-paket')->with('message', 'Data Berhasil Dihapus!');
        } else {
            return redirect('program-paket')->with('error', 'Data Tidak Ditemukan!');
        }
    }
}
