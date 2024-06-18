<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRekening extends Model
{
    use HasFactory;
    protected $table = 'tb_rekening';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nm_bank',
        'nm_rekening',
        'no_rek',
    ];

    protected static function boot()
    {
        parent::boot();
    
        // Menambahkan event listener untuk event 'saving'
        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                // Mengecualikan kolom bertipe tanggal dan kolom yang tidak perlu diubah ke huruf kecil
                if (!in_array($key, ['no_rek']) && is_string($value)) {
                    $model->{$key} = strtolower($value);
                }
            }
        });
    } 
}
