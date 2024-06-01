<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaDaftar extends Model
{
    use HasFactory;
    protected $table = 'tb_biaya_pendaftaran'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'biaya_daftar',
        'active',
    ];
    
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
