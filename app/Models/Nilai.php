<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Nilai extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'nilai';
    protected static $logAttributes = [
        'no_induk',
        'program_kursus',
        'nilai',
    ];

    // Tambahkan properti fillable
    protected $fillable = [
        'no_induk',
        'kd_program',
        'program_kursus',
        'nilai',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'no_induk',
                'program_kursus',
                'nilai',
            ]) // Atribut yang dilacak
            ->useLogName('Nilai Peserta') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
