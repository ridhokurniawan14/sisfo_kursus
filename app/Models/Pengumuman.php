<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Pengumuman extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'tb_pengumuman'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    protected static $logAttributes = [
        'jenis',
        'judul',
        'ket',
        'untuk',
        'foto',
    ];

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
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'jenis',
                'judul',
                'ket',
                'untuk',
                'foto',
            ]) // Atribut yang dilacak
            ->useLogName('Pengumuman') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
