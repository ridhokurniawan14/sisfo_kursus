<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AngketPenilaian extends Model
{
    use HasFactory;
    protected $table = 'tb_penilaian'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_induk',
        'tgl',
        'var1',
        'var2',
        'var3',
        'var4',
        'var5',
        'var6',
        'var7',
        'var8',
        'var9',
        'var10',
        'var11',
        'var12',
        'saran',
        'var1_tutor',
        'var2_tutor',
        'var3_tutor',
        'var4_tutor',
        'var5_tutor',
        'var6_tutor',
        'var7_tutor',
        'var8_tutor',
        'var9_tutor',
        'var10_tutor',
        'var11_tutor',
        'var12_tutor',
        'var13_tutor',
        'saran_tutor',
    ];    

    protected static function boot()
    {
        parent::boot();

        // Menambahkan event listener untuk event 'saving'
        static::saving(function ($angketPesertaDidikBaru) {
            // Mengonversi kolom 'saran' menjadi huruf kecil sebelum disimpan
            $angketPesertaDidikBaru->saran = strtolower($angketPesertaDidikBaru->saran);
            $angketPesertaDidikBaru->saran_tutor = strtolower($angketPesertaDidikBaru->saran_tutor);
            // Jangan melakukan konversi untuk kolom-kolom lain
        });
    }
}
