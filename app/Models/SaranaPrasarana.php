<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SaranaPrasarana extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'tb_sarpras'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    protected static $logAttributes = ['jenis', 'status', 'nm_sarpras', 'banyak', 'ket'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jenis',
        'status',
        'nm_sarpras',
        'banyak',
        'ket',
    ];
    protected static function boot()
    {
        parent::boot();

        // Menambahkan event listener untuk event 'saving'
        static::saving(function ($saranaPrasarana) {
            // Mengonversi semua inputan menjadi huruf kecil sebelum disimpan
            $saranaPrasarana->jenis = strtolower($saranaPrasarana->jenis);
            $saranaPrasarana->status = strtolower($saranaPrasarana->status);
            $saranaPrasarana->nm_sarpras = strtolower($saranaPrasarana->nm_sarpras);
            $saranaPrasarana->ket = strtolower($saranaPrasarana->ket);
        });
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['jenis', 'status', 'nm_sarpras', 'banyak', 'ket']) // Atribut yang dilacak
            ->useLogName('Sarana Prasarana') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
