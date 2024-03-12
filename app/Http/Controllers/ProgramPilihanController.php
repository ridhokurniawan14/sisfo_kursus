<?php

namespace App\Http\Controllers;

use App\Models\ProgramPilihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProgramPilihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-master.program-pilihan.index', [
            "halaman" => "Program Pilihan",
            "title" => "Data Master",
            "tab_title" => "Data Program Pilihan",
            "datas" => DB::table('tb_pilihan')
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
            'program'  => ['required', 'unique:tb_pilihan'],
            'harga'  => ['required'],
        ]);
        
        // Mengonversi 'program' menjadi huruf kecil sebelum disimpan
        $validateData['program'] = strtolower($validateData['program']);

        // Menghapus tanda titik dari harga sebelum disimpan
        $validateData['harga'] = str_replace('.', '', $request->harga);

        ProgramPilihan::create($validateData);

        // Catat aktivitas dalam log
        // ActivityLogger::logActivity('create', 'Kategori Kode Surat Masuk dengan deskripsi '.ucwords($request->ket), '');

        return redirect('/program-pilihan')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramPilihan $programPilihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramPilihan $programPilihan)
    {
        return view('dashboard.data-master.program-pilihan.edit', [
            "halaman" => "Program Pilihan",
            "title" => "Data Master",
            "tab_title" => "Data Program Pilihan",
            "datas" => DB::table('tb_pilihan')
                        ->orderBy('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                        ->get(),
            "cari" => $programPilihan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramPilihan $programPilihan)
    {
        $validatedData = $request->validate([
            'program' => ['required', Rule::unique('tb_pilihan')->ignore($programPilihan->id)],
            'harga' => ['required'],
        ]);
    
        // Mengonversi 'program' menjadi huruf kecil sebelum disimpan
        $validatedData['program'] = strtolower($validatedData['program']);
    
        // Menghapus tanda titik dari harga sebelum disimpan
        $validatedData['harga'] = str_replace('.', '', $request->harga);
    
        // Simpan data jika validasi berhasil
        $programPilihan->update($validatedData);
        
        // Catat aktivitas dalam log
        // ActivityLogger::logActivity('create', 'Kategori Kode Surat Masuk dengan deskripsi '.ucwords($request->ket), '');
    
        return redirect('/program-pilihan')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramPilihan $programPilihan)
    {
        if($programPilihan) {
            $programPilihan->delete();
            // Catat aktivitas dalam log
            // ActivityLogger::logActivity('delete', 'Kode Surat Masuk dengan kode '.ucwords($jam->kode).' -> '.ucwords($jam->ket), '');

            return redirect('program-pilihan')->with('message', 'Data Berhasil Dihapus!');
        } else {
            return redirect('program-pilihan')->with('error', 'Data Tidak Ditemukan!');
        }
    }
}
