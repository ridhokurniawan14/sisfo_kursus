<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProfilLembaga extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'tb_profile'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    protected static $logAttributes = [
        'nm_lembaga',
        'npsn',
        'bentuk',
        'sts_lembaga',
        'sts',
        'sk_izin',
        'sk_pendirian',
        'tgl_sk_pendirian',
        'tgl_sk_izin',
        'alamat',
        'rt',
        'rw',
        'kel',
        'kec',
        'kd_pos',
        'kab',
        'provinsi',
        'no_tel',
        'no_fax',
        'email',
        'web',
        'but_kus',
        'nm_yayasan',
        'nm_pajak',
        'no_npwp',
        'nm_bank',
        'bank_cabang',
        'nm_rekening',
        'luas_tanah',
        'luas_tanah_bkn',
        'kat_lembaga',
        'ms_ijin',
        'sumber_dana',
        'no_sertifikat',
        'tgl_sertifikat',
        'no_sk_akreditasi',
        'mulai_berlaku',
        'ms_akreditasi',
        'hasil',
        'penilai',
        'logo',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nm_lembaga',
        'npsn',
        'bentuk',
        'sts_lembaga',
        'sts',
        'sk_izin',
        'sk_pendirian',
        'tgl_sk_pendirian',
        'tgl_sk_izin',
        'alamat',
        'rt',
        'rw',
        'kel',
        'kec',
        'kd_pos',
        'kab',
        'provinsi',
        'no_tel',
        'no_fax',
        'email',
        'web',
        'but_kus',
        'nm_yayasan',
        'nm_pajak',
        'no_npwp',
        'nm_bank',
        'bank_cabang',
        'nm_rekening',
        'luas_tanah',
        'luas_tanah_bkn',
        'kat_lembaga',
        'ms_ijin',
        'sumber_dana',
        'no_sertifikat',
        'tgl_sertifikat',
        'no_sk_akreditasi',
        'mulai_berlaku',
        'ms_akreditasi',
        'hasil',
        'penilai',
        'logo',
    ];

    protected static function boot()
    {
        parent::boot();

        // Menambahkan event listener untuk event 'saving'
        static::saving(function ($profilLembaga) {
            // Mengonversi semua inputan menjadi huruf kecil sebelum disimpan
            $profilLembaga->nm_lembaga = strtolower($profilLembaga->nm_lembaga);
            $profilLembaga->npsn = strtolower($profilLembaga->npsn);
            $profilLembaga->bentuk = strtolower($profilLembaga->bentuk);
            $profilLembaga->sts_lembaga = strtolower($profilLembaga->sts_lembaga);
            $profilLembaga->sts = strtolower($profilLembaga->sts);
            $profilLembaga->sk_izin = strtolower($profilLembaga->sk_izin);
            $profilLembaga->sk_pendirian = strtolower($profilLembaga->sk_pendirian);
            $profilLembaga->alamat = strtolower($profilLembaga->alamat);
            $profilLembaga->kel = strtolower($profilLembaga->kel);
            $profilLembaga->kec = strtolower($profilLembaga->kec);
            $profilLembaga->kab = strtolower($profilLembaga->kab);
            $profilLembaga->provinsi = strtolower($profilLembaga->provinsi);
            $profilLembaga->email = strtolower($profilLembaga->email);
            $profilLembaga->web = strtolower($profilLembaga->web);
            $profilLembaga->nm_yayasan = strtolower($profilLembaga->nm_yayasan);
            $profilLembaga->nm_pajak = strtolower($profilLembaga->nm_pajak);
            $profilLembaga->nm_bank = strtolower($profilLembaga->nm_bank);
            $profilLembaga->bank_cabang = strtolower($profilLembaga->bank_cabang);
            $profilLembaga->nm_rekening = strtolower($profilLembaga->nm_rekening);
            $profilLembaga->kat_lembaga = strtolower($profilLembaga->kat_lembaga);
            $profilLembaga->sumber_dana = strtolower($profilLembaga->sumber_dana);
            $profilLembaga->hasil = strtolower($profilLembaga->hasil);
            $profilLembaga->penilai = strtolower($profilLembaga->penilai);
            // Masukkan kolom lain yang ingin Anda konversi ke huruf kecil di sini
        });
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'nm_lembaga',
                'npsn',
                'bentuk',
                'sts_lembaga',
                'sts',
                'sk_izin',
                'sk_pendirian',
                'tgl_sk_pendirian',
                'tgl_sk_izin',
                'alamat',
                'rt',
                'rw',
                'kel',
                'kec',
                'kd_pos',
                'kab',
                'provinsi',
                'no_tel',
                'no_fax',
                'email',
                'web',
                'but_kus',
                'nm_yayasan',
                'nm_pajak',
                'no_npwp',
                'nm_bank',
                'bank_cabang',
                'nm_rekening',
                'luas_tanah',
                'luas_tanah_bkn',
                'kat_lembaga',
                'ms_ijin',
                'sumber_dana',
                'no_sertifikat',
                'tgl_sertifikat',
                'no_sk_akreditasi',
                'mulai_berlaku',
                'ms_akreditasi',
                'hasil',
                'penilai',
                'logo',
            ]) // Atribut yang dilacak
            ->useLogName('Profil Lembaga') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
