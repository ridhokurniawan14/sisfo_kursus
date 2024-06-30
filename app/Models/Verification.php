<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Verification extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'tb_pendaftar_verifikasi'; // Use the correct table name
    protected $primaryKey = 'id';
    protected $appends = ['angsuran_count'];
    protected static $logAttributes = [
        'no_induk',
        'pil_prog',
        'angsuran1',
        'angsuran2',
        'angsuran3',
        'angsuran4',
        'angsuran5',
        'biaya_kursus',
        'biaya_daftar',
        'discount',
        'tot_biaya',
        'kekurangan',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_induk',
        'kd_jam',
        'pil_prog',
        'kd_paket',
        'kd_tambahan',
        'kd_tambahan2',
        'kd_tambahan3',
        'kd_tambahan4',
        'kd_pilihan1',
        'kd_pilihan2',
        'kd_pilihan3',
        'kd_pilihan4',
        'kd_pilihan5',
        'kd_pilihan6',
        'biaya_kursus',
        'biaya_daftar',
        'discount',
        'tot_biaya',
        'kekurangan',
        'angsuran1',
        'angsuran2',
        'tgl_angsuran2',
        'angsuran3',
        'tgl_angsuran3',
        'angsuran4',
        'tgl_angsuran4',
        'angsuran5',
        'tgl_angsuran5',
        'ket',
    ];

    protected static function boot()
    {
        parent::boot();

        // Menambahkan event listener untuk event 'saving'
        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                // Mengecualikan kolom bertipe tanggal dan kolom yang tidak perlu diubah ke huruf kecil
                if (!in_array($key, ['tgl_angsuran2', 'tgl_angsuran3', 'tgl_angsuran4', 'tgl_angsuran5', 'created_at', 'updated_at']) && is_string($value)) {
                    $model->{$key} = strtolower($value);
                }
            }
        });
    }
    public function getAngsuranCountAttribute()
    {
        $count = 0;
        for ($i = 1; $i <= 5; $i++) {
            if ($this->{"angsuran$i"} > 0) {
                $count++;
            }
        }
        return $count;
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'no_induk',
                'pil_prog',
                'angsuran1',
                'angsuran2',
                'angsuran3',
                'angsuran4',
                'angsuran5',
                'biaya_kursus',
                'biaya_daftar',
                'discount',
                'tot_biaya',
                'kekurangan',
            ]) // Atribut yang dilacak
            ->useLogName('Verifikasi Data') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
