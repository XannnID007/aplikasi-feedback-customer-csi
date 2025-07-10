<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanCsi extends Model
{
    use HasFactory;

    protected $table = 'laporan_csi';

    protected $fillable = [
        'tanggal_laporan',
        'periode_mulai',
        'periode_selesai',
        'total_responden',
        'indeks_kepuasan',
        'detail_kategori',
        'statistik_tambahan'
    ];

    protected $casts = [
        'tanggal_laporan' => 'date',
        'periode_mulai' => 'date',
        'periode_selesai' => 'date',
        'indeks_kepuasan' => 'decimal:2',
        'detail_kategori' => 'array',
        'statistik_tambahan' => 'array'
    ];

    // Accessor
    public function getKategoriCsiAttribute()
    {
        $csi = $this->indeks_kepuasan;

        if ($csi >= 81) return 'Sangat Puas';
        if ($csi >= 66) return 'Puas';
        if ($csi >= 51) return 'Cukup Puas';
        if ($csi >= 35) return 'Kurang Puas';
        return 'Tidak Puas';
    }
}
