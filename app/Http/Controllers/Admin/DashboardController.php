<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UmpanBalik;
use App\Models\KategoriPenilaian;
use App\Models\Pertanyaan;
use App\Services\CsiService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $csiService;

    public function __construct()
    {
        // Uncomment jika CsiService sudah dibuat
        // $this->csiService = new CsiService();
    }

    public function index()
    {
        try {
            $statistik = [
                'total_feedback' => UmpanBalik::count(),
                'feedback_bulan_ini' => UmpanBalik::whereMonth('created_at', Carbon::now()->month)->count(),
                'feedback_hari_ini' => UmpanBalik::whereDate('created_at', Carbon::today())->count(),
                'rata_rating' => UmpanBalik::avg('rating_keseluruhan'),
            ];

            // Data untuk grafik
            $feedbackPerBulan = UmpanBalik::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
                ->whereYear('created_at', Carbon::now()->year)
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();

            // CSI terbaru - sementara kosong jika service belum ada
            $csiTerbaru = [
                'total_responden' => 0,
                'indeks_kepuasan' => 0,
                'kategori_csi' => 'Tidak ada data',
                'detail_kategori' => [],
            ];

            // Jika CsiService sudah dibuat, uncomment ini:
            // $csiTerbaru = $this->csiService->hitungCsi(Carbon::now()->subMonth(), Carbon::now());

            return view('admin.dashboard', compact('statistik', 'feedbackPerBulan', 'csiTerbaru'));
        } catch (\Exception $e) {
            // Fallback jika ada error
            $statistik = [
                'total_feedback' => 0,
                'feedback_bulan_ini' => 0,
                'feedback_hari_ini' => 0,
                'rata_rating' => 0,
            ];

            $feedbackPerBulan = collect();
            $csiTerbaru = [
                'total_responden' => 0,
                'indeks_kepuasan' => 0,
                'kategori_csi' => 'Tidak ada data',
                'detail_kategori' => [],
            ];

            return view('admin.dashboard', compact('statistik', 'feedbackPerBulan', 'csiTerbaru'));
        }
    }
}
