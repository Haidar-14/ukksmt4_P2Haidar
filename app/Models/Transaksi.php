<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';
    
    
    protected $primaryKey = 'id_parkir';
    
  
    public $timestamps = false;
    
    
    protected $fillable = [
        'id_kendaraan',
        'waktu_masuk',
        'waktu_keluar',
        'id_tarif',
        'durasi_jam',
        'biaya_total',
        'status',
        'id_user',
        'id_area'
    ];
    
    
    protected $casts = [
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
    ];
    
 
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }
    

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif');
    }
    
  
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
   
    public function area()
    {
        return $this->belongsTo(AreaParkir::class, 'id_area');
    }
    
  
    public function hitungBiaya()
    {
       
        if (!$this->waktu_keluar) {
            return 0;
        }
        
        
        $durasi = $this->waktu_masuk->diffInHours($this->waktu_keluar);
        
        
        if ($durasi < 1) {
            $durasi = 1;
        }
        
        
        $this->durasi_jam = $durasi;
        
     
        $biaya = $durasi * $this->tarif->tarif_per_jam;
        
        
        if ($this->tarif->tarif_maksimal_harian && $biaya > $this->tarif->tarif_maksimal_harian) {
            $biaya = $this->tarif->tarif_maksimal_harian;
        }
        
        
        $this->biaya_total = $biaya;
        
        return $biaya;
    }
}