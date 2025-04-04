<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'dokter';
    protected $fillable = ['nama', 'spesialisasi'];
    
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_dokter');
    }
}