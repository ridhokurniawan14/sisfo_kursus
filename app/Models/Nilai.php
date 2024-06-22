<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai'; 

    // Tambahkan properti fillable
    protected $fillable = [
        'no_induk',
        'kd_program',
        'program_kursus',
        'nilai',
    ];
}
