<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'alternatifs';

    protected $fillable = [
        'kode_alternatif',
        'nama_alternatif',
        'description'
    ];
}
