<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataPendaftarExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('tb_pendaftar')
                    ->join('tb_pendaftar_verifikasi', 'tb_pendaftar.no_induk', '=', 'tb_pendaftar_verifikasi.no_induk')
                    ->orderByDesc('tb_pendaftar.id')
                    ->select('tb_pendaftar.*', 'tb_pendaftar_verifikasi.*') // Pilih kolom yang ingin Anda sertakan
                    ->get();
    }
    public function headings(): array
    {
        return [
            'id',
            'no_induk',
            'nm_lengkap',
            'tmp_lahir',
            'tgl_lahir',
            'gender',
            'nisn',
            'nik',
            'agama',
            'kewarganegaraan',
            'pend_akhir',
            'email',
            'no_hp',
            'status_pekerjaan',
            'tgl_masuk',
            'password',
            'alamat',
            'rt',
            'rw',
            'kel',
            'kec',
            'kd_pos',
            'kab',
            'provinsi',
            'jns_tinggal',
            'nm_ayah',
            'nik_ayah',
            'tgl_ayah',
            'pend_ayah',
            'pek_ayah',
            'nm_ibu',
            'nik_ibu',
            'tgl_ibu',
            'pend_ibu',
            'pek_ibu',
            'alamat_ortu',
            'hp_ortu',
            'telepon_ortu',
            'anak_ke',
            'nm_wali',
            'nik_wali',
            'tgl_wali',
            'pend_wali',
            'pek_wali',
            'alamat_wali',
            'hp_wali',
            'kd_jam',
            'pil_prog',
            'kd_paket',
            'kd_tambahan',
            'kd_pilihan1',
            'kd_pilihan2',
            'kd_pilihan3',
            'kd_pilihan4',
            'kd_pilihan5',
            'kd_pilihan6',
            'biaya_kursus',
            'discount',
            'tot_biaya',
            'kekurangan',
            'angsuran1',
            'angsuran2',
            'tgl_angsuran2',
            'angsuran3',
            'tgl_angsuran3',
            'angsuran4',
            'tgl_angsuran4',
            'angsuran5',
            'tgl_angsuran5',
            'ket',
        ];
    }
}
