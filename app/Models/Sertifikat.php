<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Sertifikat extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'tb_sertifikat';
    protected static $logAttributes = [
        'no_sertifikat', 'kategori', 'tgl_ujian', 'tgl_pembuatan', 'no_induk',
        'merger_certificate',
    ];
    protected $fillable = [
        'no_sertifikat', 'kategori', 'tgl_ujian', 'tgl_pembuatan', 'no_induk',
        'merger_certificate', 'qrcode', 'hash_file'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'no_sertifikat', 'kategori', 'tgl_ujian', 'tgl_pembuatan', 'no_induk',
                'merger_certificate',
            ]) // Atribut yang dilacak
            ->useLogName('Certificate') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
