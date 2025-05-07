<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $fillable = [
        'kode_alternatif',
        'nama_alternatif',
        'description'
    ];

    // Definisikan relationship dengan Penilaian
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'alternatif_id');
    }

    // Relationship dengan VikorCalculation (jika diperlukan)
    public function vikorCalculations()
    {
        return $this->hasMany(VikorCalculation::class, 'alternatif_id');
    }
}
