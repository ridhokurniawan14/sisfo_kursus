<?php

namespace App\Http\Controllers;

use App\Models\HakAkses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HakAksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-master.hak-akses.index', [
            "halaman" => "Hak Akses",
            "title" => "Data Master",
            "tab_title" => "Data Hak Akses",
            "datas" => DB::table('tb_hak_akses')
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
            'hak_akses'  => ['required', 'unique:tb_hak_akses'],
        ]);

        // Mengonversi 'hak_akses' menjadi huruf kecil sebelum disimpan
        $validateData['hak_akses'] = strtolower($validateData['hak_akses']);

        HakAkses::create($validateData);

        // Catat aktivitas dalam log
        // ActivityLogger::logActivity('create', 'Kategori Kode Surat Masuk dengan deskripsi '.ucwords($request->ket), '');

        return redirect('/admin/user-category')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(HakAkses $userCategory)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HakAkses $userCategory)
    {
        return view('dashboard.data-master.hak-akses.edit', [
            "halaman" => "Hak Akses",
            "title" => "Data Master",
            "tab_title" => "Data Hak Akses",
            "datas" => DB::table('tb_hak_akses')
                ->orderBy('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                ->get(),
            "cari" => $userCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HakAkses $userCategory)
    {
        $validateData = $request->validate([
            'hak_akses'  => ['required', 'unique:tb_hak_akses'],
        ]);

        // Mengonversi 'hak_akses' menjadi huruf kecil sebelum disimpan
        $validateData['hak_akses'] = strtolower($validateData['hak_akses']);

        if ($request->hak_akses != $userCategory->hak_akses) {
            $rules['hak_akses'] = ['required', 'unique:tb_hak_akses'];
        }

        $validateData = $request->validate($rules);

        // Perbarui data menggunakan instance model yang telah ditemukan
        $userCategory->update($validateData);

        // Catat aktivitas dalam log
        // ActivityLogger::logActivity('create', 'Kategori Kode Surat Masuk dengan deskripsi '.ucwords($request->ket), '');

        return redirect('/admin/user-category')->with('message', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HakAkses $userCategory)
    {
        if ($userCategory) {
            $userCategory->delete();
            // Catat aktivitas dalam log
            // ActivityLogger::logActivity('delete', 'Kode Surat Masuk dengan kode '.ucwords($userCategory->kode).' -> '.ucwords($jam->ket), '');

            return redirect('/admin/user-category')->with('message', 'Data Berhasil Dihapus!');
        } else {
            return redirect('/admin/user-category')->with('error', 'Data Tidak Ditemukan!');
        }
    }
}
