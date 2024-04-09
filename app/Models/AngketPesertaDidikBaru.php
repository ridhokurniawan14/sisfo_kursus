<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AngketPesertaDidikBaru extends Model
{
    use HasFactory;
    protected $table = 'tb_angket'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_induk',
        'Nama',
        'Tanggal',
        'jawab1',
        'jawab2',
        'jawab3',
        'jawab4',
        'jawab5',
        'jawab6',
        'jawab7',
        'jawab8',
        'jawab9',
        'jawab10',
        'jawab11',
    ];

    protected static function boot()
    {
        parent::boot();

        // Menambahkan event listener untuk event 'saving'
        static::saving(function ($angketPesertaDidikBaru) {
            // Mengonversi semua inputan menjadi huruf kecil sebelum disimpan
            $angketPesertaDidikBaru->no_induk = strtolower($angketPesertaDidikBaru->no_induk);
            $angketPesertaDidikBaru->Nama = strtolower($angketPesertaDidikBaru->Nama);
            // Anda dapat melanjutkan dengan konversi untuk kolom lain jika perlu
        });
    }
}
