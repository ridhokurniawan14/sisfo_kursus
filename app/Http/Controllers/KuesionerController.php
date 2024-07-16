<?php

namespace App\Http\Controllers;

use App\Models\AngketPenilaian;
use App\Models\AngketPesertaDidikBaru;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KuesionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkDataAngket = Pendaftar::leftJoin('tb_angket as a', 'tb_pendaftar.no_induk', '=', 'a.no_induk')
            ->leftJoin('tb_sertifikat as s', 'tb_pendaftar.no_induk', '=', 's.no_induk')
            ->leftJoin('tb_penilaian as p', 'tb_pendaftar.no_induk', '=', 'p.no_induk')
            ->where('tb_pendaftar.no_induk', auth()->user()->no_induk)
            ->first();

        return view('siswa.kuesioner.index', [
            "halaman" => "Kuesioner",
            "title" => "Kuesioner",
            "tab_title" => "Kuesioner Peserta",
            "checkDataAngket" => $checkDataAngket,
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
            'jawab1' => 'required',
            'jawab1' => 'required',
            'jawab2' => 'required',
            'jawab3' => 'required',
            'jawab4' => 'required',
            'jawab5' => 'required',
            'jawab6' => 'required',
            'jawab7' => 'required',
            'jawab8' => 'required',
            'jawab9' => 'required',
            'jawab10' => 'required',
            'jawab11' => 'required',
        ]);

        $validatedData['no_induk'] = auth()->user()->no_induk;
        $validatedData['Nama'] = auth()->user()->nm_lengkap;
        $validatedData['Tanggal'] = date('y-m-d');

        AngketPesertaDidikBaru::create($validatedData);

        return redirect()->back()->with('message', 'Kuesioner berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(404);
    }
    public function storePenilaian(Request $request)
    {
        $request->validate([
            'var1' => 'required|integer|min:1|max:5',
            'var2' => 'required|integer|min:1|max:5',
            'var3' => 'required|integer|min:1|max:5',
            'var4' => 'required|integer|min:1|max:5',
            'var5' => 'required|integer|min:1|max:5',
            'var6' => 'required|integer|min:1|max:5',
            'var7' => 'required|integer|min:1|max:5',
            'var8' => 'required|integer|min:1|max:5',
            'var9' => 'required|integer|min:1|max:5',
            'var10' => 'required|integer|min:1|max:5',
            'var11' => 'required|integer|min:1|max:5',
            'var12' => 'required|integer|min:1|max:5',
            'saran' => 'nullable|string',
            'var1_tutor' => 'required|integer|min:1|max:5',
            'var2_tutor' => 'required|integer|min:1|max:5',
            'var3_tutor' => 'required|integer|min:1|max:5',
            'var4_tutor' => 'required|integer|min:1|max:5',
            'var5_tutor' => 'required|integer|min:1|max:5',
            'var6_tutor' => 'required|integer|min:1|max:5',
            'var7_tutor' => 'required|integer|min:1|max:5',
            'var8_tutor' => 'required|integer|min:1|max:5',
            'var9_tutor' => 'required|integer|min:1|max:5',
            'var10_tutor' => 'required|integer|min:1|max:5',
            'var11_tutor' => 'required|integer|min:1|max:5',
            'var12_tutor' => 'required|integer|min:1|max:5',
            'var13_tutor' => 'required|integer|min:1|max:5',
            'saran_tutor' => 'nullable|string',
        ]);
        AngketPenilaian::create([
            'no_induk' => auth()->user()->no_induk,
            'tgl' => now(),
            'var1' => $request->var1,
            'var2' => $request->var2,
            'var3' => $request->var3,
            'var4' => $request->var4,
            'var5' => $request->var5,
            'var6' => $request->var6,
            'var7' => $request->var7,
            'var8' => $request->var8,
            'var9' => $request->var9,
            'var10' => $request->var10,
            'var11' => $request->var11,
            'var12' => $request->var12,
            'saran' => $request->saran,
            'var1_tutor' => $request->var1_tutor,
            'var2_tutor' => $request->var2_tutor,
            'var3_tutor' => $request->var3_tutor,
            'var4_tutor' => $request->var4_tutor,
            'var5_tutor' => $request->var5_tutor,
            'var6_tutor' => $request->var6_tutor,
            'var7_tutor' => $request->var7_tutor,
            'var8_tutor' => $request->var8_tutor,
            'var9_tutor' => $request->var9_tutor,
            'var10_tutor' => $request->var10_tutor,
            'var11_tutor' => $request->var11_tutor,
            'var12_tutor' => $request->var12_tutor,
            'var13_tutor' => $request->var13_tutor,
            'saran_tutor' => $request->saran_tutor,
        ]);
        return redirect()->back()->with('message', 'Survey berhasil disimpan!');
    }
}
