<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'tb_sertifikat';

    protected $fillable = [
        'no_sertifikat', 'kategori', 'tgl_ujian', 'tgl_pembuatan', 'no_induk',
        'merger_certificate', 'qrcode', 'hash_file'
    ];
}
