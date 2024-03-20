<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;
    protected $table = 'tb_pengumuman'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jenis',
        'judul',
        'ket',
        'untuk',
        'foto',
        'created_by',
    ];
    protected static function boot()
    {
        parent::boot();

        // Menambahkan event listener untuk event 'saving'
        static::saving(function ($pengumuman) {
            // Mengonversi semua inputan menjadi huruf kecil sebelum disimpan
            $pengumuman->jenis = strtolower($pengumuman->jenis);
            $pengumuman->judul = strtolower($pengumuman->judul);
            $pengumuman->ket = strtolower($pengumuman->ket);
            $pengumuman->untuk = strtolower($pengumuman->untuk);
            $pengumuman->created_by = strtolower($pengumuman->created_by);
        });
    }
}
