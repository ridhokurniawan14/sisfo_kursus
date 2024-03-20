<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-master.jam.index', [
            "halaman" => "Jam Kursus",
            "title" => "Data Master",
            "tab_title" => "Jam",
            "datas" => DB::table('tb_jam')
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
        $validateData = $request->validate([
            'jam'  => ['required', 'unique:tb_jam'],
        ]);
        
        // Mengonversi 'jam' menjadi huruf kecil sebelum disimpan
        $validateData['jam'] = strtolower($validateData['jam']);

        Jam::create($validateData);

        // Catat aktivitas dalam log
        // ActivityLogger::logActivity('create', 'Kategori Kode Surat Masuk dengan deskripsi '.ucwords($request->ket), '');

        return redirect('/jam')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jam $jam)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jam $jam)
    {
        return view('dashboard.data-master.jam.edit', [
            "halaman" => "Jam Kursus",
            "title" => "Data Master",
            "tab_title" => "Jam",
            "datas" => DB::table('tb_jam')
                        ->orderBy('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                        ->get(),
            "cari" => $jam,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jam $jam)
    {
        $validateData = $request->validate([
            'jam'  => ['required'],
        ]);
        
        // Mengonversi 'jam' menjadi huruf kecil sebelum disimpan
        $validateData['jam'] = strtolower($validateData['jam']);

        if($request->jam != $jam->jam) {
            $rules['jam'] = ['required', 'unique:tb_jam'];
        }

        $validateData = $request->validate($rules);
        
        // Perbarui data menggunakan instance model yang telah ditemukan
        $jam->update($validateData);

        // Catat aktivitas dalam log
        // ActivityLogger::logActivity('create', 'Kategori Kode Surat Masuk dengan deskripsi '.ucwords($request->ket), '');

        return redirect('/jam')->with('message', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jam $jam)
    {
        if($jam) {
            $jam->delete();
            // Catat aktivitas dalam log
            // ActivityLogger::logActivity('delete', 'Kode Surat Masuk dengan kode '.ucwords($jam->kode).' -> '.ucwords($jam->ket), '');

            return redirect('jam')->with('message', 'Data Berhasil Dihapus!');
        } else {
            return redirect('jam')->with('error', 'Data Tidak Ditemukan!');
        }
    }
}
