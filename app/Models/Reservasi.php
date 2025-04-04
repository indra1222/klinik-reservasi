<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservasi extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'reservasi';
    protected $fillable = ['id_dokter', 'id_pasien', 'tanggal', 'jam', 'status', 'keluhan'];
    
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }
    
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
}