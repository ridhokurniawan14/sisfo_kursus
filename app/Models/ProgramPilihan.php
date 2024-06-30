<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProgramPilihan extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'tb_pilihan';
    protected $primaryKey = 'id';
    protected static $logAttributes = ['program', 'harga'];

    protected $fillable = [
        'program',
        'harga',
    ];

    public function programPaket()
    {
        return $this->belongsToMany(ProgramPaket::class, 'tb_paket_kursus_pilihan', 'pilihan_id', 'paket_kursus_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['program', 'harga']) // Atribut yang dilacak
            ->useLogName('Program') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
