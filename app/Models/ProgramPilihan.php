<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramPilihan extends Model
{
    use HasFactory;
    
    protected $table = 'tb_pilihan';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'program',
        'harga',
    ];

    public function programPaket()
    {
        return $this->belongsToMany(ProgramPaket::class, 'tb_paket_kursus_pilihan', 'pilihan_id', 'paket_kursus_id');
    }
}