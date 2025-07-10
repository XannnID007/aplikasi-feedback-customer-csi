<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriPenilaian;

class KategoriPenilaianSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            [
                'nama_kategori' => 'Kualitas Makanan',
                'keterangan' => 'Penilaian terhadap rasa, tekstur, dan kualitas makanan',
                'bobot' => 5,
                'status_aktif' => true
            ],
            [
                'nama_kategori' => 'Kualitas Pelayanan',
                'keterangan' => 'Penilaian terhadap keramahan dan kecepatan pelayanan',
                'bobot' => 4,
                'status_aktif' => true
            ],
            [
                'nama_kategori' => 'Kebersihan',
                'keterangan' => 'Penilaian terhadap kebersihan tempat dan peralatan',
                'bobot' => 4,
                'status_aktif' => true
            ],
            [
                'nama_kategori' => 'Harga',
                'keterangan' => 'Penilaian terhadap kesesuaian harga dengan kualitas',
                'bobot' => 3,
                'status_aktif' => true
            ],
            [
                'nama_kategori' => 'Suasana',
                'keterangan' => 'Penilaian terhadap kenyamanan dan suasana tempat',
                'bobot' => 3,
                'status_aktif' => true
            ]
        ];

        foreach ($kategori as $item) {
            KategoriPenilaian::create($item);
        }
    }
}
