<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Pendaftar::select('p.no_induk', 'p.*', 'pv.*', 'f.*', 'j.*')
            ->from('tb_pendaftar as p')
            ->join('tb_pendaftar_verifikasi as pv', 'p.no_induk', '=', 'pv.no_induk')
            ->leftJoin('tb_foto as f', 'p.no_induk', '=', 'f.no_induk')
            ->leftJoin('tb_jam as j', 'pv.kd_jam', '=', 'j.id')
            ->where('p.id', auth()->user()->id)
            ->first();

        if (!$student) {
            abort(404); // Menampilkan halaman 404 jika data tidak ditemukan
        }
        $programs = [];
        $kd_programs = [];

        if ($student->pil_prog === 'paket') {
            if ($student->kd_paket) {
                $programPaket = DB::table('tb_paket_kursus as pk')
                    ->join('tb_paket_kursus_pilihan as pkp', 'pk.id', '=', 'pkp.paket_kursus_id')
                    ->join('tb_pilihan as p', 'pkp.pilihan_id', '=', 'p.id')
                    ->where('pk.kode', $student->kd_paket)
                    ->select('p.program', 'p.id')
                    ->get();

                foreach ($programPaket as $item) {
                    $programs[] = $item->program;
                    $kd_programs[] = $item->id;
                }
            }

            $kd_tambahan_fields = ['kd_tambahan', 'kd_tambahan2', 'kd_tambahan3', 'kd_tambahan4'];
            foreach ($kd_tambahan_fields as $field) {
                if ($student->$field) {
                    $programTambahan = DB::table('tb_pilihan')
                        ->where('id', $student->$field)
                        ->select('program', 'id')
                        ->first();

                    if ($programTambahan) {
                        $programs[] = $programTambahan->program;
                        $kd_programs[] = $programTambahan->id;
                    }
                }
            }
        } elseif ($student->pil_prog === 'pilihan') {
            for ($i = 1; $i <= 6; $i++) {
                $kd_pilihan_field = 'kd_pilihan' . $i;
                $kd_pilihan_value = $student->$kd_pilihan_field;

                if ($kd_pilihan_value) {
                    $program = DB::table('tb_pilihan')
                        ->where('id', $kd_pilihan_value)
                        ->select('program', 'id')
                        ->first();

                    if ($program) {
                        $programs[] = $program->program;
                        $kd_programs[] = $program->id;
                    }
                }
            }
        }
        // Fetch existing scores
        $existing_scores = Nilai::where('no_induk', auth()->user()->no_induk)->get()->keyBy('kd_program');

        // Process the predikat for each existing score
        foreach ($existing_scores as $score) {
            $score->predikat = $this->getPredikat($score->nilai);
        }

        return view('siswa.nilai.index', [
            "halaman" => "Nilai",
            "title" => "Nilai",
            "tab_title" => "Detail Nilai",
            "data" => $student,
            "programs" => $programs,
            "kd_programs" => $kd_programs,
            "existing_scores" => $existing_scores,
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
        abort(404);
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
}
