<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Ajuan;
use App\Models\Jabatan;
use App\Models\Kehadiran;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nuptk',
        'nip',
        'nama_lengkap',
        'jenis_kelamin',
        'notelepon',
        'jabatansid',
        'alamat',
        'role',
        'fotos',
        'statususers',
        'email',
        'password',
        'isadmin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function jabatan(){
        return $this->belongsTo(Jabatan::class, 'jabatansid', 'id');
    }

    public function kehadiran(){
        return $this->hasMany(Kehadiran::class, 'pegawais_id', 'id');
    }

    public function ajuans(){
        return $this->hasMany(Ajuan::class, 'pegawais_id', 'id');
    }
}
