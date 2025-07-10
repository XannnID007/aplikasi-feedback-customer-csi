<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriPenilaian extends Model
{
    use HasFactory;

    protected $table = 'kategori_penilaian';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'keterangan',
        'bobot',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean'
    ];

    // Relasi
    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'kategori_id');
    }

    // Accessor & Mutator
    public function setNamaKategoriAttribute($value)
    {
        $this->attributes['nama_kategori'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Scope
    public function scopeAktif($query)
    {
        return $query->where('status_aktif', true);
    }
}
