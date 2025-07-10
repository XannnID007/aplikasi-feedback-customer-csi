<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pertanyaan;
use App\Models\KategoriPenilaian;

class PertanyaanSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = KategoriPenilaian::all();

        // Kualitas Makanan
        $kualitasMakanan = $kategori->where('nama_kategori', 'Kualitas Makanan')->first();
        $pertanyaanMakanan = [
            'Bagaimana rasa makanan yang Anda pesan?',
            'Bagaimana kualitas bahan makanan yang digunakan?',
            'Bagaimana tingkat kematangan makanan yang disajikan?',
            'Bagaimana variasi menu yang tersedia?'
        ];

        foreach ($pertanyaanMakanan as $index => $pertanyaan) {
            Pertanyaan::create([
                'kategori_id' => $kualitasMakanan->id,
                'teks_pertanyaan' => $pertanyaan,
                'tipe_pertanyaan' => 'rating',
                'urutan' => $index + 1,
                'wajib_diisi' => true,
                'status_aktif' => true
            ]);
        }

        // Kualitas Pelayanan
        $kualitasPelayanan = $kategori->where('nama_kategori', 'Kualitas Pelayanan')->first();
        $pertanyaanPelayanan = [
            'Bagaimana keramahan staf dalam melayani?',
            'Bagaimana kecepatan pelayanan yang diberikan?',
            'Bagaimana pengetahuan staf tentang menu?',
            'Bagaimana responsivitas staf terhadap keluhan?'
        ];

        foreach ($pertanyaanPelayanan as $index => $pertanyaan) {
            Pertanyaan::create([
                'kategori_id' => $kualitasPelayanan->id,
                'teks_pertanyaan' => $pertanyaan,
                'tipe_pertanyaan' => 'rating',
                'urutan' => $index + 1,
                'wajib_diisi' => true,
                'status_aktif' => true
            ]);
        }

        // Kebersihan
        $kebersihan = $kategori->where('nama_kategori', 'Kebersihan')->first();
        $pertanyaanKebersihan = [
            'Bagaimana kebersihan tempat makan?',
            'Bagaimana kebersihan peralatan makan?',
            'Bagaimana kebersihan toilet?',
            'Bagaimana kebersihan area dapur (jika terlihat)?'
        ];

        foreach ($pertanyaanKebersihan as $index => $pertanyaan) {
            Pertanyaan::create([
                'kategori_id' => $kebersihan->id,
                'teks_pertanyaan' => $pertanyaan,
                'tipe_pertanyaan' => 'rating',
                'urutan' => $index + 1,
                'wajib_diisi' => true,
                'status_aktif' => true
            ]);
        }

        // Harga
        $harga = $kategori->where('nama_kategori', 'Harga')->first();
        $pertanyaanHarga = [
            'Bagaimana kesesuaian harga dengan kualitas makanan?',
            'Bagaimana kesesuaian harga dengan porsi makanan?',
            'Bagaimana transparansi harga yang ditampilkan?'
        ];

        foreach ($pertanyaanHarga as $index => $pertanyaan) {
            Pertanyaan::create([
                'kategori_id' => $harga->id,
                'teks_pertanyaan' => $pertanyaan,
                'tipe_pertanyaan' => 'rating',
                'urutan' => $index + 1,
                'wajib_diisi' => true,
                'status_aktif' => true
            ]);
        }

        // Suasana
        $suasana = $kategori->where('nama_kategori', 'Suasana')->first();
        $pertanyaanSuasana = [
            'Bagaimana kenyamanan tempat duduk?',
            'Bagaimana suasana dan ambience restoran?',
            'Bagaimana tingkat kebisingan di restoran?'
        ];

        foreach ($pertanyaanSuasana as $index => $pertanyaan) {
            Pertanyaan::create([
                'kategori_id' => $suasana->id,
                'teks_pertanyaan' => $pertanyaan,
                'tipe_pertanyaan' => 'rating',
                'urutan' => $index + 1,
                'wajib_diisi' => true,
                'status_aktif' => true
            ]);
        }
    }
}
