<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    
    protected $table = 'tb_tarif';
    

    protected $primaryKey = 'id_tarif';
    

    public $timestamps = false;
    
    
    protected $fillable = [
        'jenis_kendaraan',
        'tarif_per_jam',
        'tarif_maksimal_harian'
    ];
    
    
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_tarif');
    }
}