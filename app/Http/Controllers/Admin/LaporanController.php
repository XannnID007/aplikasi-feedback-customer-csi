<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CsiService;
use App\Models\UmpanBalik;
use App\Models\KategoriPenilaian;
use App\Models\Cabang;
use Carbon\Carbon;

class LaporanController extends Controller
{
    protected $csiService;

    public function __construct(CsiService $csiService)
    {
        $this->csiService = $csiService;
    }

    public function index(Request $request)
    {
        $tanggalMulai = $request->get('tanggal_mulai', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $tanggalSelesai = $request->get('tanggal_selesai', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $cabangId = $request->get('cabang_id');
        $viewType = $request->get('view_type', 'overview'); // overview, per_cabang, perbandingan

        // Ambil data cabang untuk dropdown
        $cabangList = Cabang::aktif()->urutan()->get();

        // Data berdasarkan view type
        $data = [];

        switch ($viewType) {
            case 'per_cabang':
                if ($cabangId) {
                    $data['laporanCsi'] = $this->csiService->hitungCsi($tanggalMulai, $tanggalSelesai, $cabangId);
                } else {
                    $data['laporanCsiPerCabang'] = $this->csiService->hitungCsiPerCabang($tanggalMulai, $tanggalSelesai);
                }
                break;

            case 'perbandingan':
                $cabangIds = $request->get('cabang_ids', []);
                if (empty($cabangIds)) {
                    $cabangIds = $cabangList->take(5)->pluck('id')->toArray(); // Ambil 5 cabang pertama sebagai default
                }
                $data['perbandinganCabang'] = $this->csiService->bandingkanCabang($tanggalMulai, $tanggalSelesai, $cabangIds);
                break;

            case 'tren':
                $tahun = $request->get('tahun', date('Y'));
                $cabangIdTren = $request->get('cabang_id_tren');
                $data['trenCsi'] = $this->csiService->getTrenCsiPerBulan($cabangIdTren, $tahun);
                $data['tahunTerpilih'] = $tahun;
                break;

            default: // overview
                $data['laporanCsi'] = $this->csiService->hitungCsi($tanggalMulai, $tanggalSelesai);
                break;
        }

        return view('admin.laporan.index', array_merge($data, [
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
            'cabangId' => $cabangId,
            'cabangList' => $cabangList,
            'viewType' => $viewType,
        ]));
    }

    public function export(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;
        $cabangId = $request->cabang_id;
        $format = $request->format;

        $laporanCsi = $this->csiService->hitungCsi($tanggalMulai, $tanggalSelesai, $cabangId);

        if ($format === 'pdf') {
            return $this->exportPdf($laporanCsi, $tanggalMulai, $tanggalSelesai, $cabangId);
        }

        return $this->exportExcel($laporanCsi, $tanggalMulai, $tanggalSelesai, $cabangId);
    }

    public function exportPerbandingan(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;
        $cabangIds = $request->cabang_ids ?? [];
        $format = $request->format;

        $perbandinganData = $this->csiService->bandingkanCabang($tanggalMulai, $tanggalSelesai, $cabangIds);

        if ($format === 'pdf') {
            return $this->exportPerbandinganPdf($perbandinganData, $tanggalMulai, $tanggalSelesai);
        }

        return $this->exportPerbandinganExcel($perbandinganData, $tanggalMulai, $tanggalSelesai);
    }

    private function exportPdf($laporanCsi, $tanggalMulai, $tanggalSelesai, $cabangId = null)
    {
        $data = [
            'laporanCsi' => $laporanCsi,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
            'cabangInfo' => $cabangId ? Cabang::find($cabangId) : null,
            'generatedAt' => now()->format('d F Y, H:i'),
        ];

        $html = view('admin.laporan.pdf-simple', $data)->render();

        // Simple PDF using DomPDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($html);

        $namaFile = 'Laporan_CSI_' . date('Y-m-d');
        if ($cabangId) {
            $cabang = Cabang::find($cabangId);
            $namaFile .= '_' . str_replace(' ', '_', $cabang->nama_cabang);
        }
        $namaFile .= '.pdf';

        return $pdf->download($namaFile);
    }

    private function exportExcel($laporanCsi, $tanggalMulai, $tanggalSelesai, $cabangId = null)
    {
        $namaFile = 'Laporan_CSI_' . date('Y-m-d');
        if ($cabangId) {
            $cabang = Cabang::find($cabangId);
            $namaFile .= '_' . str_replace(' ', '_', $cabang->nama_cabang);
        }
        $namaFile .= '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $namaFile . '"',
        ];

        $callback = function () use ($laporanCsi, $cabangId) {
            $file = fopen('php://output', 'w');

            // Header CSV
            if ($cabangId) {
                $cabang = Cabang::find($cabangId);
                fputcsv($file, ['Laporan CSI - ' . $cabang->nama_cabang]);
                fputcsv($file, []);
            }

            fputcsv($file, ['Kategori', 'MIS', 'MSS', 'WF', 'WS', 'Performance %', 'Total Responden']);

            // Data
            foreach ($laporanCsi['detail_kategori'] as $detail) {
                fputcsv($file, [
                    $detail['nama_kategori'],
                    $detail['mis'],
                    $detail['mss'],
                    $detail['wf'],
                    $detail['ws'],
                    number_format(($detail['mss'] / 5) * 100, 1) . '%',
                    $detail['total_responden'] ?? 0
                ]);
            }

            // Summary
            fputcsv($file, []);
            fputcsv($file, ['RINGKASAN']);
            fputcsv($file, ['Total Responden', $laporanCsi['total_responden']]);
            fputcsv($file, ['Indeks Kepuasan', $laporanCsi['indeks_kepuasan'] . '%']);
            fputcsv($file, ['Kategori CSI', $laporanCsi['kategori_csi']]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportPerbandinganPdf($perbandinganData, $tanggalMulai, $tanggalSelesai)
    {
        $data = [
            'perbandinganData' => $perbandinganData,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
            'generatedAt' => now()->format('d F Y, H:i'),
        ];

        $html = view('admin.laporan.pdf-perbandingan', $data)->render();

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($html);

        $namaFile = 'Perbandingan_CSI_Cabang_' . date('Y-m-d') . '.pdf';
        return $pdf->download($namaFile);
    }

    private function exportPerbandinganExcel($perbandinganData, $tanggalMulai, $tanggalSelesai)
    {
        $namaFile = 'Perbandingan_CSI_Cabang_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $namaFile . '"',
        ];

        $callback = function () use ($perbandinganData) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, ['Nama Cabang', 'Total Responden', 'Indeks Kepuasan (%)', 'Kategori CSI']);

            // Data per cabang
            foreach ($perbandinganData as $data) {
                fputcsv($file, [
                    $data['nama_cabang'],
                    $data['total_responden'],
                    $data['indeks_kepuasan'],
                    $data['kategori_csi']
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
