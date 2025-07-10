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
}
