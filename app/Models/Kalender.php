<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    use HasFactory;
    protected $fillable = [
        'bulan',
        'tahun',
        'totalhariefektif',
        'statusmasterkalenders'
    ];
    protected $table = 'masterkalenders';
}
