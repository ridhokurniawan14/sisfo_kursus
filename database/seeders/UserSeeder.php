<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan satu data pengguna
        User::create([
            'nm_lengkap' => 'Admin',
            'gender' => 'l',
            'tmp_lahir' => 'Batam',
            'tgl_lahir' => '2002-09-18',
            'agama' => 'islam',
            'status' => 'belum nikah',
            'alamat' => 'jl.bengawan',
            'pend_akhir' => 's1',
            'jurusan' => 'informatika',
            'email' => 'admin@gmail.com',
            'no_hp' => '082234176922',
            'posisi' => '5',
            'tgl_masuk' => '2024-12-01',
            'username' => 'Admin',
            'password' => bcrypt('admin123'), // Gunakan bcrypt untuk enkripsi password
            'nik' => '3510161809020000',
            'nm_ibu' => 'ibu admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
