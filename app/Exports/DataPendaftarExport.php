<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataPendaftarExport implements FromCollection, WithHeadings
{
    protected $year;

    public function __construct($year = null)
    {
        $this->year = $year;
    }

    public function collection()
    {
        $query = DB::table('tb_pendaftar')
            ->join('tb_pendaftar_verifikasi', 'tb_pendaftar.no_induk', '=', 'tb_pendaftar_verifikasi.no_induk')
            ->orderByDesc('tb_pendaftar.id')
            ->select('tb_pendaftar.*', 'tb_pendaftar_verifikasi.*');

        if ($this->year) {
            $query->whereYear('tb_pendaftar.tgl_masuk', $this->year);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'No. Induk',
            'Nama Lengkap',
            'Tempat Lahir',
            'Tgl. Lahir',
            'Jenis Kelamin',
            'NISN',
            'NIK',
            'Agama',
            'Kewarganegaraan',
            'Pendidikan Akhir',
            'Email',
            'HP',
            'Status Pekerjaan',
            'Tgl. Daftar',
            'Password',
            'Alamat',
            'RT',
            'RW',
            'Kelurahan',
            'Kecamatan',
            'Kode Pos',
            'Kabupaten',
            'Provinsi',
            'Jenis Tinggal',
            'Nama Ayah',
            'NIK Ayah',
            'Tgl. Lahir Ayah',
            'Pendidikan Ayah',
            'Pekerjaan Ayah',
            'Nama Ibu',
            'NIK Ibu',
            'Tgl. Lahir Ibu',
            'Pendidikan Ibu',
            'Pekerjaan Ibu',
            'Alamat Orang Tua',
            'HP Orang tua',
            'Telepon Orang tua',
            'Anak ke',
            'Nama Wali',
            'NIK Wali',
            'Tanggal Wali',
            'Pendidikan Wali',
            'Pekerjaan Wali',
            'Alamat Wali',
            'HP Wali',
            'Dibuat',
            'Diperbarui',
            'Kode Jam',
            'Pilihan Program',
            'Kode Paket',
            'Kode Tambahan',
            'Kode Tambahan 2',
            'Kode Tambahan 3',
            'Kode Tambahan 4',
            'Kode Pilihan 1',
            'Kode Pilihan 2',
            'Kode Pilihan 3',
            'Kode Pilihan 4',
            'Kode Pilihan 5',
            'Kode Pilihan 6',
            'Biaya Kursus',
            'Biaya Daftar',
            'Discount',
            'Total Biaya',
            'Kekurangan',
            'Angsuran 1',
            'Angsuran 2',
            'Tgl. Angsuran 2',
            'Angsuran 3',
            'Tgl. Angsuran 3',
            'Angsuran 4',
            'Tgl. Angsuran 4',
            'Angsuran 5',
            'Tgl. Angsuran 5',
            'Keterangan',
        ];
    }
}
