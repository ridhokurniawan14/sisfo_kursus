<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasAkreditasi extends Model
{
    use HasFactory;
    protected $table = 'tb_berkas_akreditasi'; // Sesuaikan dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id'; // Atur primary key sesuai kebutuhan Anda
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nm_brk',
        'thn',
        'nm_fl',
    ];

    protected static function boot()
    {
        parent::boot();

        // Menambahkan event listener untuk event 'saving'
        static::saving(function ($berkas) {
            // Mengonversi semua input menjadi huruf kecil sebelum disimpan
            $berkas->nm_brk = strtolower($berkas->nm_brk);
            $berkas->nm_fl = strtolower($berkas->nm_fl);
        });
    }
}
