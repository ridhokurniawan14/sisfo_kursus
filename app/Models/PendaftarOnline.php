<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarOnline extends Model
{
    use HasFactory;
    protected $table = 'tb_ppdb'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'nm_lengkap',
        'gender',
        'tmp_lahir',
        'tgl_lahir',
        'agama',
        'kewarganegaraan',
        'status_pekerjaan',
        'hobi',
        'no_hp',
        'alamat',
        'pend_akhir',
        'nm_ortu',
        'pek_ortu',
        'alamat_ortu',
        'info_dari',
        'no_induk',
        'tgl_daftar',
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