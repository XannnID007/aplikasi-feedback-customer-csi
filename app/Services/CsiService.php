<?php

namespace App\Services;

use App\Models\UmpanBalik;
use App\Models\KategoriPenilaian;
use App\Models\DetailUmpanBalik;
use App\Models\Cabang;
use Carbon\Carbon;

class CsiService
{
     /**
      * Hitung CSI dengan filter cabang opsional
      */
     public function hitungCsi($tanggalMulai, $tanggalSelesai, $cabangId = null)
     {
          $query = UmpanBalik::whereBetween('tanggal_kunjungan', [$tanggalMulai, $tanggalSelesai])
               ->with(['detailUmpanBalik.pertanyaan.kategori', 'cabang']);

          // Filter berdasarkan cabang jika ada
          if ($cabangId) {
               $query->where('cabang_id', $cabangId);
          }

          $feedback = $query->get();

          if ($feedback->isEmpty()) {
               return [
                    'total_responden' => 0,
                    'indeks_kepuasan' => 0,
                    'kategori_csi' => 'Tidak ada data',
                    'detail_kategori' => [],
                    'cabang_info' => $cabangId ? Cabang::find($cabangId) : null,
               ];
          }

          $kategori = KategoriPenilaian::aktif()->get();
          $detailKategori = [];
          $totalWeightedScore = 0;
          $totalWeight = 0;

          foreach ($kategori as $kat) {
               $ratingKategori = $feedback->flatMap(function ($fb) use ($kat) {
                    return $fb->detailUmpanBalik->where('pertanyaan.kategori_id', $kat->id);
               });

               if ($ratingKategori->count() > 0) {
                    $mis = $kat->bobot; // Mean Importance Score
                    $mss = $ratingKategori->avg('nilai_rating'); // Mean Satisfaction Score
                    $wf = $mis / $kategori->sum('bobot'); // Weight Factor
                    $ws = $wf * $mss; // Weight Score

                    $detailKategori[] = [
                         'nama_kategori' => $kat->nama_kategori,
                         'mis' => $mis,
                         'mss' => round($mss, 2),
                         'wf' => round($wf, 4),
                         'ws' => round($ws, 4),
                         'total_responden' => $ratingKategori->count(),
                    ];

                    $totalWeightedScore += $ws;
                    $totalWeight += $wf;
               }
          }

          $csiValue = $totalWeight > 0 ? ($totalWeightedScore / $totalWeight) * 20 : 0;

          return [
               'total_responden' => $feedback->count(),
               'indeks_kepuasan' => round($csiValue, 2),
               'kategori_csi' => $this->getKategoriCsi($csiValue),
               'detail_kategori' => $detailKategori,
               'cabang_info' => $cabangId ? Cabang::find($cabangId) : null,
          ];
     }

     /**
      * Hitung CSI per cabang dalam periode tertentu
      */
     public function hitungCsiPerCabang($tanggalMulai, $tanggalSelesai)
     {
          $cabangList = Cabang::aktif()->urutan()->get();
          $hasilPerCabang = [];

          foreach ($cabangList as $cabang) {
               $csiCabang = $this->hitungCsi($tanggalMulai, $tanggalSelesai, $cabang->id);

               if ($csiCabang['total_responden'] > 0) {
                    $hasilPerCabang[] = [
                         'cabang' => $cabang,
                         'csi_data' => $csiCabang,
                    ];
               }
          }

          return $hasilPerCabang;
     }

     /**
      * Bandingkan CSI antar cabang
      */
     public function bandingkanCabang($tanggalMulai, $tanggalSelesai, $cabangIds = [])
     {
          $hasil = [];

          if (empty($cabangIds)) {
               $cabangIds = Cabang::aktif()->pluck('id')->toArray();
          }

          foreach ($cabangIds as $cabangId) {
               $cabang = Cabang::find($cabangId);
               if ($cabang) {
                    $csiData = $this->hitungCsi($tanggalMulai, $tanggalSelesai, $cabangId);

                    if ($csiData['total_responden'] > 0) {
                         $hasil[] = [
                              'cabang_id' => $cabangId,
                              'nama_cabang' => $cabang->nama_cabang,
                              'total_responden' => $csiData['total_responden'],
                              'indeks_kepuasan' => $csiData['indeks_kepuasan'],
                              'kategori_csi' => $csiData['kategori_csi'],
                              'detail_kategori' => $csiData['detail_kategori'],
                         ];
                    }
               }
          }

          // Urutkan berdasarkan CSI tertinggi
          usort($hasil, function ($a, $b) {
               return $b['indeks_kepuasan'] <=> $a['indeks_kepuasan'];
          });

          return $hasil;
     }

     /**
      * Dapatkan tren CSI per bulan untuk cabang tertentu
      */
     public function getTrenCsiPerBulan($cabangId = null, $tahun = null)
     {
          if (!$tahun) {
               $tahun = date('Y');
          }

          $tren = [];

          for ($bulan = 1; $bulan <= 12; $bulan++) {
               $tanggalMulai = Carbon::create($tahun, $bulan, 1)->startOfMonth();
               $tanggalSelesai = Carbon::create($tahun, $bulan, 1)->endOfMonth();

               $csiData = $this->hitungCsi($tanggalMulai, $tanggalSelesai, $cabangId);

               $tren[] = [
                    'bulan' => $bulan,
                    'nama_bulan' => $tanggalMulai->format('F'),
                    'total_responden' => $csiData['total_responden'],
                    'indeks_kepuasan' => $csiData['indeks_kepuasan'],
                    'kategori_csi' => $csiData['kategori_csi'],
               ];
          }

          return $tren;
     }

     private function getKategoriCsi($csi)
     {
          if ($csi >= 81) return 'Sangat Puas';
          if ($csi >= 66) return 'Puas';
          if ($csi >= 51) return 'Cukup Puas';
          if ($csi >= 35) return 'Kurang Puas';
          return 'Tidak Puas';
     }
}
