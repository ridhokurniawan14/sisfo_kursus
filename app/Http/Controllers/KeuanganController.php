<?php

namespace App\Http\Controllers;

use App\Models\DataRekening;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index()
    {
        $student = Pendaftar::select('p.no_induk', 'p.*', 'pv.*', 'f.*', 'j.*')
            ->from('tb_pendaftar as p')
            ->join('tb_pendaftar_verifikasi as pv', 'p.no_induk', '=', 'pv.no_induk')
            ->leftJoin('tb_foto as f', 'p.no_induk', '=', 'f.no_induk')
            ->leftJoin('tb_jam as j', 'pv.kd_jam', '=', 'j.id')
            ->where('p.no_induk', auth()->user()->no_induk)
            ->first();

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
        // Ambil data angsuran dan tanggal angsuran
        $installments = [];

        // Angsuran pertama menggunakan tgl_masuk
        if ($student->angsuran1) {
            $installments[] = [
                'angsuran' => $student->angsuran1,
                'tanggal' => $student->tgl_masuk,
                'keterangan' => $student->angsuran1 == $student->tot_biaya ? 'Pelunasan' : 'Angsuran 1',
            ];
        }
        // Angsuran berikutnya menggunakan tgl_angsuran2, tgl_angsuran3, tgl_angsuran4, tgl_angsuran5
        for ($i = 2; $i <= 5; $i++) {
            $installment_field = 'angsuran' . $i;
            $date_field = 'tgl_angsuran' . $i;
            if ($student->$installment_field && $student->$date_field) {
                $installments[] = [
                    'angsuran' => $student->$installment_field,
                    'tanggal' => $student->$date_field,
                    'keterangan' => 'Angsuran ' . $i,
                ];
            }
        }
        return view('siswa.keuangan.index', [
            "halaman" => "Keuangan",
            "title" => "Keuangan",
            "tab_title" => "Detail Keuangan",
            "data" => $student,
            "programs" => $programs,
            "kd_programs" => $kd_programs,
            "installments" => $installments,
            "rekenings" => DataRekening::orderBy('id')->get(),
        ]);
    }
}
