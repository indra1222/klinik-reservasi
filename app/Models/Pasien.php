<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pasien extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    
    protected $table = 'pasien';
    protected $fillable = ['nama', 'kontak', 'email', 'password'];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_pasien');
    }
}