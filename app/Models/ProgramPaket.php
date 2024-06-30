<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProgramPaket extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'tb_paket_kursus';
    protected $primaryKey = 'id';
    protected static $logAttributes = ['kode', 'program_pilihan', 'harga'];

    protected $fillable = [
        'kode',
        'program_pilihan',
        'harga',
    ];

    public function pilihan()
    {
        return $this->belongsToMany(ProgramPilihan::class, 'tb_paket_kursus_pilihan', 'paket_kursus_id', 'pilihan_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['kode', 'program_pilihan', 'harga']) // Atribut yang dilacak
            ->useLogName('Program Paket') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
