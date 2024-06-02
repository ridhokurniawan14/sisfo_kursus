<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaDaftar extends Model
{
    use HasFactory;
    
    protected $table = 'tb_biaya_pendaftaran'; // Nama tabel
    protected $primaryKey = 'id';

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
}
