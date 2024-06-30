<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;
    protected $table = 'tb_pendidik'; // Ganti 'nama_tabel_anda' dengan nama tabel yang sebenarnya
    protected $primaryKey = 'id';
    protected static $logAttributes = [
        'nm_lengkap',
        'gender',
        'tmp_lahir',
        'tgl_lahir',
        'agama',
        'status',
        'alamat',
        'pend_akhir',
        'jurusan',
        'email',
        'no_hp',
        'posisi',
        'tgl_masuk',
        'username',
        'nik',
        'nm_ibu',
        'foto',
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
        'status',
        'alamat',
        'pend_akhir',
        'jurusan',
        'email',
        'no_hp',
        'posisi',
        'tgl_masuk',
        'username',
        'password',
        'nik',
        'nm_ibu',
        'foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getRouteKeyName()
    {
        return 'email';
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'nm_lengkap',
                'gender',
                'tmp_lahir',
                'tgl_lahir',
                'agama',
                'status',
                'alamat',
                'pend_akhir',
                'jurusan',
                'email',
                'no_hp',
                'posisi',
                'tgl_masuk',
                'username',
                'nik',
                'nm_ibu',
                'foto',
            ]) // Atribut yang dilacak
            ->useLogName('Data Pendidik') // Nama log opsional
            ->logOnlyDirty()    // Hanya mencatat perubahan
            ->dontSubmitEmptyLogs(); // Tidak mencatat jika tidak ada perubahan
    }
}
