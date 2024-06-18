<?php

namespace App\Http\Controllers;

use App\Models\DataRekening;
use Illuminate\Http\Request;

class DataRekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-master.data-rekening.index', [
            "halaman" => "Data Rekening",
            "title" => "Data Master",
            "tab_title" => "Data Rekening",
            "datas" => DataRekening::orderBy('id')->get(),
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
            'nm_bank'  => ['required'],
            'nm_rekening' => ['required'],
            'no_rek'  => ['required'],
        ]);

        $dataRekening = DataRekening::create($validateData);

        return redirect('/data-rekening')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataRekening $dataRekening)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataRekening $dataRekening)
    {
        return view('dashboard.data-master.data-rekening.edit', [
            "halaman" => "Program Paket",
            "title" => "Data Master",
            "tab_title" => "Data Program Paket",
            "cari" => $dataRekening,
            "datas" => DataRekening::orderBy('id')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataRekening $dataRekening)
    {
        $validateData = $request->validate([
            'nm_bank' => 'required',
            'nm_rekening' => 'required',
            'no_rek' => 'required',
        ]);

        // Update data utama
        $dataRekening->update($validateData);

        return redirect('/data-rekening')->with('message', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataRekening $dataRekening)
    {
        // Hapus data program rekening
        $dataRekening->delete();

        // Catat aktivitas dalam log (opsional)
        // ActivityLogger::logActivity('delete', 'Kategori Kode Surat Masuk dengan deskripsi '.ucwords($dataRekening->kode), '');

        return redirect('/data-rekening')->with('message', 'Data berhasil dihapus!');
    }
}
