<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabang';

    protected $fillable = [
        'nama_cabang',
        'slug',
        'alamat',
        'telepon',
        'email',
        'jam_operasional',
        'deskripsi',
        'status_aktif',
        'urutan'
    ];

    protected $casts = [
        'status_aktif' => 'boolean'
    ];

    // Relasi
    public function umpanBalik()
    {
        return $this->hasMany(UmpanBalik::class, 'cabang_id');
    }

    // Accessor & Mutator
    public function setNamaCabangAttribute($value)
    {
        $this->attributes['nama_cabang'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Scope
    public function scopeAktif($query)
    {
        return $query->where('status_aktif', true);
    }

    public function scopeUrutan($query)
    {
        return $query->orderBy('urutan');
    }

    // Helper methods
    public function getTotalFeedbackAttribute()
    {
        return $this->umpanBalik()->count();
    }

    public function getRataRatingAttribute()
    {
        return $this->umpanBalik()->avg('rating_keseluruhan');
    }
}
