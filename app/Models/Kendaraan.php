<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    //sesuaikan dengan nama table yang ada di database
    protected $table = 'tb_kendaraan';
    

    protected $primaryKey = 'id_kendaraan';
    
   
    public $timestamps = false;
    
    
    protected $fillable = [
        'plat_nomor',
        'jenis_kendaraan',
        'warna',
        'pemilik',
        'id_user'
    ];
    
    
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_kendaraan');
    }
    
  
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}