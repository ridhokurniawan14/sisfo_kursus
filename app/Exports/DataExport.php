<?php

namespace App\Exports;

use App\Models\AngketPenilaian;
use App\Models\AngketPesertaDidikBaru;
use App\Models\Pendaftar;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function collection()
    {
        if ($this->type === 'peserta_belum_isi_angket') {
            // Mengambil data peserta yang belum memiliki entri di tb_penilaian
            $pesertaBelumIsiAngket = Pendaftar::whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('tb_penilaian')
                      ->whereRaw('tb_penilaian.no_induk = tb_pendaftar.no_induk');
            })->get(['no_induk','nm_lengkap', 'no_hp']); // Memilih kolom nm_lengkap dan no_hp saja
    
            return $pesertaBelumIsiAngket;
        } elseif ($this->type === 'angket_penilaian') {
            return AngketPenilaian::all();
        } elseif ($this->type === 'angket_peserta_didik_baru') {
            return AngketPesertaDidikBaru::all();
        }

        return new Collection();
    }
}
