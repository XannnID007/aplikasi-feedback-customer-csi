<?php

namespace App\Services;

use App\Models\UmpanBalik;
use App\Models\KategoriPenilaian;
use App\Models\DetailUmpanBalik;
use Carbon\Carbon;

class CsiService
{
     public function hitungCsi($tanggalMulai, $tanggalSelesai)
     {
          $feedback = UmpanBalik::whereBetween('tanggal_kunjungan', [$tanggalMulai, $tanggalSelesai])
               ->with(['detailUmpanBalik.pertanyaan.kategori'])
               ->get();

          if ($feedback->isEmpty()) {
               return [
                    'total_responden' => 0,
                    'indeks_kepuasan' => 0,
                    'kategori_csi' => 'Tidak ada data',
                    'detail_kategori' => [],
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
          ];
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
