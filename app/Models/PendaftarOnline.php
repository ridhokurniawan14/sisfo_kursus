<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PendaftarOnline extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'tb_ppdb'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    protected static $logAttributes = [
        'nm_lengkap',
        'gender',
        'tmp_lahir',
        'tgl_lahir',
        'agama',
        'kewarganegaraan',
        'status_pekerjaan',
        'hobi',
        'no_hp',
        'alamat',
        'pend_akhir',
        'nm_ortu',
        'pek_ortu',
        'alamat_ortu',
        'info_dari',
        'no_induk',
        'tgl_daftar',
        'program',
        'harga',
        'biaya_daftar',
        'total',
        'status',
        'id_program',
        'id_pilihan',
        'pil_program'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'nm_lengkap',
        'gender',
        'tmp_lahir',
        'tgl_lahir',
        'agama',
        'kewarganegaraan',
        'status_pekerjaan',
        'hobi',
        'no_hp',
        'alamat',
        'pend_akhir',
        'nm_ortu',
        'pek_ortu',
        'alamat_ortu',
        'info_dari',
        'no_induk',
        'tgl_daftar',
        'program',
        'harga',
        'biaya_daftar',
        'total',
        'status',
        'id_program',
        'id_pilihan',
        'pil_program'
    ];
    // protected static function boot()
    // {
    //     parent::boot();

    //     // Menambahkan event listener untuk event 'saving'
    //     static::saving(function ($model) {
    //         // Mengonversi semua atribut ke huruf kecil sebelum disimpan
    //         foreach ($model->getAttributes() as $key => $value) {
    //             $model->{$key} = strtolower($value);
    //         }
    //     });
    // }
    protected static function boot()
    {
        parent::boot();

        // Ubah semua string ke huruf kecil saat menyimpan
        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                $model->{$key} = is_string($value) ? strtolower($value) : $value;
            }
        });

        // Tambahkan data ke tb_pendaftar_verifikasi hanya jika status berubah dari unpaid ke paid
        static::updated(function ($pendaftar) {
            if (
                $pendaftar->isDirty('status') &&
                $pendaftar->getOriginal('status') === 'unpaid' &&
                $pendaftar->status === 'paid'
            ) {
                // Cek jika belum ada data dengan no_induk yang sama
                if (!\App\Models\Verification::where('no_induk', $pendaftar->no_induk)->exists()) {
                    \App\Models\Verification::create([
                        'no_induk'      => $pendaftar->no_induk,
                        'biaya_kursus'  => $pendaftar->harga,
                        'biaya_daftar'  => $pendaftar->biaya_daftar,
                        'discount'      => 0,
                        'tot_biaya'     => $pendaftar->total,
                        'kekurangan'    => 0,
                        'angsuran1'     => $pendaftar->total,
                        'angsuran2'     => 0,
                        'angsuran3'     => 0,
                        'angsuran4'     => 0,
                        'angsuran5'     => 0,
                        'ket'           => 'lunas',
                        'kd_paket'      => $pendaftar->id_program,
                        'kd_pilihan1'   => $pendaftar->id_pilihan,
                        'pil_prog'      => $pendaftar->pil_program
                    ]);
                }
            }
        });
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'nm_lengkap',
                'gender',
                'biaya_daftar',
                'tmp_lahir',
                'tgl_lahir',
                'agama',
                'kewarganegaraan',
                'status_pekerjaan',
                'hobi',
                'no_hp',
                'alamat',
                'pend_akhir',
                'nm_ortu',
                'pek_ortu',
                'alamat_ortu',
                'info_dari',
                'no_induk',
                'tgl_daftar',
                'program',
                'harga',
                'total',
                'status',
                'id_program',
                'id_pilihan',
                'pil_program'
        ]) // Atribut yang dilacak
            ->useLogName('Pendaftar Online') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
