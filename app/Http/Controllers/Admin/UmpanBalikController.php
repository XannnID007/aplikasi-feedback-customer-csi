<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UmpanBalik;
use App\Models\KategoriPenilaian;

class UmpanBalikController extends Controller
{
    public function index(Request $request)
    {
        $query = UmpanBalik::with(['detailUmpanBalik.pertanyaan.kategori'])
            ->orderBy('created_at', 'desc');

        if ($request->has('tanggal_mulai') && $request->tanggal_mulai) {
            $query->whereDate('tanggal_kunjungan', '>=', $request->tanggal_mulai);
        }

        if ($request->has('tanggal_selesai') && $request->tanggal_selesai) {
            $query->whereDate('tanggal_kunjungan', '<=', $request->tanggal_selesai);
        }

        $umpanBalik = $query->paginate(15);

        return view('admin.umpan-balik.index', compact('umpanBalik'));
    }

    public function show(UmpanBalik $umpanBalik)
    {
        $umpanBalik->load(['detailUmpanBalik.pertanyaan.kategori']);

        return view('admin.umpan-balik.show', compact('umpanBalik'));
    }

    public function destroy(UmpanBalik $umpanBalik)
    {
        $umpanBalik->delete();

        return redirect()->route('admin.umpan-balik.index')
            ->with('success', 'Umpan balik berhasil dihapus.');
    }
}
