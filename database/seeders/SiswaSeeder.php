<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftar;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambah data ke tabel tb_pendaftar menggunakan model Pendaftar
        Pendaftar::create([
            'no_induk' => '1234567890',
            'nm_lengkap' => 'John Doe',
            'tmp_lahir' => 'Jakarta',
            'tgl_lahir' => '2000-01-01',
            'gender' => 'l',
            'nisn' => '9876543210',
            'nik' => '1234567890123456',
            'agama' => 'Islam',
            'kewarganegaraan' => 'WNI',
            'pend_akhir' => 'SMA',
            'email' => 'johndoe@example.com',
            'no_hp' => '081234567890',
            'status_pekerjaan' => 'Belum Bekerja',
            'tgl_masuk' => '2024-01-01',
            'password' => bcrypt('siswa123'),
            'alamat' => 'Jl. Raya No. 1, Jakarta',
            'rt' => '001',
            'rw' => '002',
            'kel' => 'Kelurahan A',
            'kec' => 'Kecamatan B',
            'kd_pos' => '12345',
            'kab' => 'Kota C',
            'provinsi' => 'DKI Jakarta',
            'jns_tinggal' => 'Kost',
            'nm_ayah' => 'Budi Doe',
            'nik_ayah' => '1234567890123456',
            'tgl_ayah' => '1975-05-01',
            'pend_ayah' => 'S1',
            'pek_ayah' => 'Dokter',
            'nm_ibu' => 'Siti Doe',
            'nik_ibu' => '1234567890123456',
            'tgl_ibu' => '1978-08-15',
            'pend_ibu' => 'S1',
            'pek_ibu' => 'Guru',
            'alamat_ortu' => 'Jl. Raya No. 1, Jakarta',
            'hp_ortu' => '081234567891',
            'telepon_ortu' => '021-23456789',
            'anak_ke' => '1',
            'nm_wali' => 'Nina Doe',
            'nik_wali' => '1234567890123456',
            'tgl_wali' => '1990-03-03',
            'pend_wali' => 'S2',
            'pek_wali' => 'Pengusaha',
            'alamat_wali' => 'Jl. Wali No. 1, Jakarta',
            'hp_wali' => '081234567892',
        ]);
    }
}
