<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;
    protected $table = 'tb_pendaftar'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $fillable = [
        'kd_jam', 'pil_prog', 'kd_paket', 'kd_tambahan', 'kd_tambahan2', 'kd_tambahan3', 
        'kd_tambahan4', 'kd_pilihan1', 'kd_pilihan2', 'kd_pilihan3', 'kd_pilihan4', 
        'kd_pilihan5', 'kd_pilihan6', 'biaya_kursus', 'biaya_daftar', 'discount', 
        'tot_biaya', 'kekurangan', 'angsuran1', 'angsuran2', 'tgl_angsuran2', 'angsuran3', 
        'tgl_angsuran3', 'angsuran4', 'tgl_angsuran4', 'angsuran5', 'tgl_angsuran5', 
        'ket', 'no_induk'
    ];   

    protected static function boot()
    {
        parent::boot();

        // Menambahkan event listener untuk event 'saving'
        static::saving(function ($model) {
            // Mengonversi semua atribut ke huruf kecil sebelum disimpan
            foreach ($model->getAttributes() as $key => $value) {
                $model->{$key} = strtolower($value);
            }
        });
    }
}
