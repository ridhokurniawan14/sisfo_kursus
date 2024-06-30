<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BiayaDaftar extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'tb_biaya_pendaftaran'; // Nama tabel
    protected $primaryKey = 'id';
    protected static $logAttributes = ['biaya_daftar'];

    // Daftar atribut yang bisa diisi secara massal
    protected $fillable = [
        'biaya_daftar',
        'active',
    ];

    // Menambahkan event listener untuk event 'creating' dan 'saving'
    protected static function boot()
    {
        parent::boot();

        // Menambahkan event listener untuk event 'creating'
        static::creating(function ($model) {
            if (is_null($model->active)) {
                $model->active = 0;
            }
        });

        // Menambahkan event listener untuk event 'saving'
        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                $model->{$key} = strtolower($value);
            }
        });
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['biaya_daftar']) // Atribut yang dilacak
            ->useLogName('Biaya Daftar') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
