<?php

namespace App\Models;

use App\Models\User;
use App\Models\MasterAbsensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kehadiran extends Model
{
    use HasFactory;
    protected $fillable = [
        'pegawais_id',
        'masterabsensis_id',
        'tgl_absensi',
        'waktu_masuk',
        'waktu_keluar',
        'latitude_masuk',
        'longitude_masuk',
        'foto_masuk',
        'latitude_keluar',
        'longitude_keluar',
        'foto_keluar',
        'jarak_absen_masuk',
        'jarak_absen_keluar'
    ];
    protected $table = 'absensis';
    public function user(){
        return $this->belongsTo(User::class, 'pegawais_id', 'id');
    }
    public function masterabsensi(){
        return $this->belongsTo(MasterAbsensi::class, 'masterabsensis_id', 'id');
    }
}
