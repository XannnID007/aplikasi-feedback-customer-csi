<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUmpanBalik extends Model
{
    use HasFactory;

    protected $table = 'detail_umpan_balik';

    protected $fillable = [
        'umpan_balik_id',
        'pertanyaan_id',
        'jawaban_teks',
        'nilai_rating'
    ];

    // Relasi
    public function umpanBalik()
    {
        return $this->belongsTo(UmpanBalik::class, 'umpan_balik_id');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'pertanyaan_id');
    }
}
