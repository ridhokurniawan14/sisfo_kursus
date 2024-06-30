<?php

namespace App\Http\Controllers;

use App\Models\ProgramPaket;
use App\Models\ProgramPilihan;
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
        $datas = DB::table('tb_paket_kursus as pk')
            ->join('tb_paket_kursus_pilihan as pkp', 'pk.id', '=', 'pkp.paket_kursus_id')
            ->join('tb_pilihan as p', 'pkp.pilihan_id', '=', 'p.id')
            ->select('pk.id', 'pk.kode', 'pk.harga', DB::raw('GROUP_CONCAT(p.program SEPARATOR ", ") as program_pilihan'))
            ->groupBy('pk.id', 'pk.kode', 'pk.harga')
            ->orderBy('pk.id')
            ->get();

        return view('dashboard.data-master.program-paket.index', [
            "halaman" => "Program Paket",
            "title" => "Data Master",
            "tab_title" => "Data Program Paket",
            "program_pilihan" => ProgramPilihan::orderBy('id')->get(),
            "datas" => $datas
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
            'kode'  => ['required', 'numeric', 'unique:tb_paket_kursus'],
            'program_pilihan'  => ['required', 'array'], // Validasi sebagai array
            'program_pilihan.*' => ['exists:tb_pilihan,id'], // Pastikan setiap item ada di tabel 'tb_pilihan'
            'harga'  => ['required'],
        ]);

        // Menghapus tanda titik dari harga sebelum disimpan
        $validateData['harga'] = str_replace('.', '', $request->harga);

        // Mengonversi array program_pilihan menjadi string yang dipisahkan oleh koma sebelum disimpan
        $validateData['program_pilihan'] = implode(',', $request->program_pilihan);

        $programPaket = ProgramPaket::create($validateData);

        // Menyimpan hubungan many-to-many ke tabel pivot
        $programPaket->pilihan()->sync($request->program_pilihan);

        return redirect('/admin/program-paket')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramPaket $programPaket)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramPaket $programPaket)
    {
        $datas = DB::table('tb_paket_kursus as pk')
            ->join('tb_paket_kursus_pilihan as pkp', 'pk.id', '=', 'pkp.paket_kursus_id')
            ->join('tb_pilihan as p', 'pkp.pilihan_id', '=', 'p.id')
            ->select('pk.id', 'pk.kode', 'pk.harga', DB::raw('GROUP_CONCAT(p.program SEPARATOR ", ") as program_pilihan'))
            ->groupBy('pk.id', 'pk.kode', 'pk.harga')
            ->orderBy('pk.id')
            ->get();

        // Ambil semua program pilihan untuk ditampilkan di dropdown
        $programPilihan = ProgramPilihan::orderBy('id')->get();

        // Ambil program yang terkait dengan paket kursus ini
        $selectedPrograms = $programPaket->pilihan()->pluck('id')->toArray();

        return view('dashboard.data-master.program-paket.edit', [
            "halaman" => "Program Paket",
            "title" => "Data Master",
            "tab_title" => "Data Program Paket",
            "cari" => $programPaket,
            "programPilihan" => $programPilihan,
            "selectedPrograms" => $selectedPrograms,
            "datas" => $datas,
            "cari" => $programPaket,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramPaket $programPaket)
    {
        $validateData = $request->validate([
            'kode' => ['required', 'numeric', Rule::unique('tb_paket_kursus')->ignore($programPaket->kode)],
            'program_pilihan' => ['required', 'array'], // Validasi sebagai array
            'program_pilihan.*' => ['exists:tb_pilihan,id'], // Pastikan setiap item ada di tabel 'tb_pilihan'
            'harga' => ['required'],
        ]);

        // Menghapus tanda titik dari harga sebelum disimpan
        $validateData['harga'] = str_replace('.', '', $request->harga);
        $formattedData = implode(",", $validateData['program_pilihan']);

        // Update data utama
        $programPaket->update([
            'kode' => $validateData['kode'],
            'program_pilihan' => $formattedData,
            'harga' => $validateData['harga']
        ]);

        // Menyimpan hubungan many-to-many ke tabel pivot
        $programPaket->pilihan()->sync($request->program_pilihan);

        // Catat aktivitas dalam log (opsional)
        // ActivityLogger::logActivity('update', 'Kategori Kode Surat Masuk dengan deskripsi '.ucwords($request->ket), '');

        return redirect('/admin/program-paket')->with('message', 'Data berhasil diupdate!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramPaket $programPaket)
    {
        // Hapus hubungan many-to-many di tabel pivot
        $programPaket->pilihan()->detach();

        // Hapus data program paket
        $programPaket->delete();

        // Catat aktivitas dalam log (opsional)
        // ActivityLogger::logActivity('delete', 'Kategori Kode Surat Masuk dengan deskripsi '.ucwords($programPaket->kode), '');

        return redirect('/admin/program-paket')->with('message', 'Data berhasil dihapus!');
    }
}
