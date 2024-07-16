<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class AngketPesertaDidikBaru extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'tb_angket'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    protected static $logAttributes = ['no_induk', 'Nama'];
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
            $angketPesertaDidikBaru->jawab1 = strtolower($angketPesertaDidikBaru->jawab1);
            $angketPesertaDidikBaru->jawab2 = strtolower($angketPesertaDidikBaru->jawab2);
            $angketPesertaDidikBaru->jawab3 = strtolower($angketPesertaDidikBaru->jawab3);
            $angketPesertaDidikBaru->jawab4 = strtolower($angketPesertaDidikBaru->jawab4);
            $angketPesertaDidikBaru->jawab5 = strtolower($angketPesertaDidikBaru->jawab5);
            $angketPesertaDidikBaru->jawab6 = strtolower($angketPesertaDidikBaru->jawab6);
            $angketPesertaDidikBaru->jawab7 = strtolower($angketPesertaDidikBaru->jawab7);
            $angketPesertaDidikBaru->jawab8 = strtolower($angketPesertaDidikBaru->jawab8);
            $angketPesertaDidikBaru->jawab9 = strtolower($angketPesertaDidikBaru->jawab9);
            $angketPesertaDidikBaru->jawab10 = strtolower($angketPesertaDidikBaru->jawab10);
            $angketPesertaDidikBaru->jawab11 = strtolower($angketPesertaDidikBaru->jawab11);
            // Anda dapat melanjutkan dengan konversi untuk kolom lain jika perlu
        });
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['no_induk', 'Nama']) // Atribut yang dilacak
            ->useLogName('Angket Peserta') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
