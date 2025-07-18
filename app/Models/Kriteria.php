<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'bobot',
        'jenis', // 'cost' atau 'benefit'
        'description'
    ];
}
