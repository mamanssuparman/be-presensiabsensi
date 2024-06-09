<?php

namespace App\Models;

use App\Models\Kehadiran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterAbsensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'latitude',
        'langitude',
        'keterangan',
        'jam_masuk',
        'jam_keluar',
        'max_alpha',
        'max_terlambat',
        'masterkalenders_id',
        'jarakabsen'
    ];
    protected $table = 'masterabsensis';
    public function kehadirans(){
        return $this->hasMany(Kehadiran::class, 'masterabsensis_id', 'id');
    }
}
