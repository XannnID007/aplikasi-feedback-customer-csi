<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan';

    protected $fillable = [
        'kategori_id',
        'teks_pertanyaan',
        'tipe_pertanyaan',
        'pilihan_jawaban',
        'urutan',
        'wajib_diisi',
        'status_aktif'
    ];

    protected $casts = [
        'pilihan_jawaban' => 'array',
        'wajib_diisi' => 'boolean',
        'status_aktif' => 'boolean'
    ];

    // Relasi
    public function kategori()
    {
        return $this->belongsTo(KategoriPenilaian::class, 'kategori_id');
    }

    public function detailUmpanBalik()
    {
        return $this->hasMany(DetailUmpanBalik::class, 'pertanyaan_id');
    }

    // Scope
    public function scopeAktif($query)
    {
        return $query->where('status_aktif', true);
    }

    public function scopeWajib($query)
    {
        return $query->where('wajib_diisi', true);
    }
}
