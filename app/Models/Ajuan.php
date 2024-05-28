<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ajuan extends Model
{
    use HasFactory;
    protected $fillable=[
        'pegawais_id',
        'jenis_ajuans',
        'tanggal_awal',
        'tanggal_akhir',
        'tujuan',
        'lampiran',
        'statusajuan',
        'alasan'
    ];
    protected $table = 'ajuans';
    public function user(){
        return $this->belonsgTo(User::class, 'pegawais_id', 'id');
    }
}
