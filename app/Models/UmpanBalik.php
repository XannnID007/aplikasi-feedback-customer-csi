<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmpanBalik extends Model
{
    use HasFactory;

    protected $table = 'umpan_balik';

    protected $fillable = [
        'nama_pelanggan',
        'email_pelanggan',
        'telepon_pelanggan',
        'tanggal_kunjungan',
        'komentar_umum',
        'rating_keseluruhan'
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
        'rating_keseluruhan' => 'decimal:2'
    ];

    // Relasi
    public function detailUmpanBalik()
    {
        return $this->hasMany(DetailUmpanBalik::class, 'umpan_balik_id');
    }

    // Accessor
    public function getNamaPelangganAttribute($value)
    {
        return $value ?? 'Anonim';
    }
}
