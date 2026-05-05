<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    
    protected $table = 'tb_shift';
    
  
    protected $primaryKey = 'id_shift';
    
 
    public $timestamps = false;
    
    
    protected $fillable = [
        'jam_masuk',
        'jam_keluar'
    ];
}