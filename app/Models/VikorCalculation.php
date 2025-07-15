<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VikorCalculation extends Model
{
    protected $table = 'vikor_calculations';
    protected $fillable = [
        'alternatif_id',
        'nilai_s',
        'nilai_r',
        'nilai_q',
        'ranking'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }

    // Tambahkan accessor untuk memudahkan
    public function getStatusAttribute()
    {
        return $this->ranking <= 5 ? 'Memenuhi Kriteria' : 'Tidak Memenuhi Kriteria';
    }
}
