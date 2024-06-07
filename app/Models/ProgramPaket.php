<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramPaket extends Model
{
    use HasFactory;
    
    protected $table = 'tb_paket_kursus';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'kode',
        'program_pilihan',
        'harga',
    ];

    public function pilihan()
    {
        return $this->belongsToMany(ProgramPilihan::class, 'tb_paket_kursus_pilihan', 'paket_kursus_id', 'pilihan_id');
    }
}