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
        'longitude',
        'keterangan',
        'jam_masuk',
        'jam_keluar',
        'max_alpha',
        'max_terlambat',
        'masterkalenders_id'
    ];
    protected $table = 'masterabsensis';
    public function kehadirans(){
        return $this->hasMany(Kehadiran::class, 'masterabsensis_id', 'id');
    }
}
