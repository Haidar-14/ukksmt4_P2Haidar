<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    
    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'role',
        'status_aktif',
        'id_shift'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    // Laravel akan pakai 'username' untuk login, bukan 'email'
    public function getAuthIdentifierName()
{
    return 'username';
}

    // Relasi ke tabel lain
    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'id_user');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_user');
    }

    public function logs()
    {
        return $this->hasMany(LogAktivitas::class, 'id_user');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift');
    }
}