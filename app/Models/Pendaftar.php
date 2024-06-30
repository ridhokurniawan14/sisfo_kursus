<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Pendaftar extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'tb_pendaftar'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    protected static $logAttributes = ['no_induk', 'nm_lengkap'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'no_induk',
        'nm_lengkap',
        'tmp_lahir',
        'tgl_lahir',
        'gender',
        'nisn',
        'nik',
        'agama',
        'kewarganegaraan',
        'pend_akhir',
        'email',
        'no_hp',
        'status_pekerjaan',
        'tgl_masuk',
        'password',
        'alamat',
        'rt',
        'rw',
        'kel',
        'kec',
        'kd_pos',
        'kab',
        'provinsi',
        'jns_tinggal',
        'nm_ayah',
        'nik_ayah',
        'tgl_ayah',
        'pend_ayah',
        'pek_ayah',
        'nm_ibu',
        'nik_ibu',
        'tgl_ibu',
        'pend_ibu',
        'pek_ibu',
        'alamat_ortu',
        'hp_ortu',
        'telepon_ortu',
        'anak_ke',
        'nm_wali',
        'nik_wali',
        'tgl_wali',
        'pend_wali',
        'pek_wali',
        'alamat_wali',
        'hp_wali'
    ];

    protected static function boot()
    {
        parent::boot();

        // Menambahkan event listener untuk event 'saving'
        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                // Mengecualikan kolom bertipe tanggal dan kolom yang tidak perlu diubah ke huruf kecil
                if (!in_array($key, ['tgl_lahir', 'tgl_ayah', 'tgl_ibu', 'tgl_wali', 'created_at', 'updated_at', 'password']) && is_string($value)) {
                    $model->{$key} = strtolower($value);
                }
            }
        });
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['no_induk', 'nm_lengkap']) // Atribut yang dilacak
            ->useLogName('Peserta Didik') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
