<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'jabatan',
        'keterangan',
        'statusjabatans'
    ];
    protected $table = 'jabatans';

    public function users(){
        return $this->hasMany(User::class, 'jabatansid', 'id');
    }
}
