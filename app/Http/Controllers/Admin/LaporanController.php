<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CsiService;
use App\Models\UmpanBalik;
use App\Models\KategoriPenilaian;
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

        $laporanCsi = $this->csiService->hitungCsi($tanggalMulai, $tanggalSelesai);

        return view('admin.laporan.index', compact('laporanCsi', 'tanggalMulai', 'tanggalSelesai'));
    }

    public function export(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;
        $format = $request->format;

        $laporanCsi = $this->csiService->hitungCsi($tanggalMulai, $tanggalSelesai);

        if ($format === 'pdf') {
            return $this->exportPdf($laporanCsi, $tanggalMulai, $tanggalSelesai);
        }

        return $this->exportExcel($laporanCsi, $tanggalMulai, $tanggalSelesai);
    }

    private function exportPdf($laporanCsi, $tanggalMulai, $tanggalSelesai)
    {
        $data = [
            'laporanCsi' => $laporanCsi,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
            'generatedAt' => now()->format('d F Y, H:i'),
        ];

        $html = view('admin.laporan.pdf-simple', $data)->render();

        // Simple PDF using DomPDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($html);

        $filename = 'Laporan_CSI_' . date('Y-m-d') . '.pdf';
        return $pdf->download($filename);
    }

    private function exportExcel($laporanCsi, $tanggalMulai, $tanggalSelesai)
    {
        $filename = 'Laporan_CSI_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($laporanCsi) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, ['Kategori', 'MIS', 'MSS', 'WF', 'WS', 'Performance %']);

            // Data
            foreach ($laporanCsi['detail_kategori'] as $detail) {
                fputcsv($file, [
                    $detail['nama_kategori'],
                    $detail['mis'],
                    $detail['mss'],
                    $detail['wf'],
                    $detail['ws'],
                    number_format(($detail['mss'] / 5) * 100, 1) . '%'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
