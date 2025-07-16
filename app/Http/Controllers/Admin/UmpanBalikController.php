<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UmpanBalik;
use App\Models\KategoriPenilaian;
use App\Models\Cabang;

class UmpanBalikController extends Controller
{
    public function index(Request $request)
    {
        $query = UmpanBalik::with(['detailUmpanBalik.pertanyaan.kategori', 'cabang'])
            ->orderBy('created_at', 'desc');

        if ($request->has('tanggal_mulai') && $request->tanggal_mulai) {
            $query->whereDate('tanggal_kunjungan', '>=', $request->tanggal_mulai);
        }

        if ($request->has('tanggal_selesai') && $request->tanggal_selesai) {
            $query->whereDate('tanggal_kunjungan', '<=', $request->tanggal_selesai);
        }

        if ($request->has('cabang_id') && $request->cabang_id) {
            $query->where('cabang_id', $request->cabang_id);
        }

        $umpanBalik = $query->paginate(15);
        $cabang = Cabang::aktif()->urutan()->get();

        return view('admin.umpan-balik.index', compact('umpanBalik', 'cabang'));
    }

    public function show(UmpanBalik $umpanBalik)
    {
        $umpanBalik->load(['detailUmpanBalik.pertanyaan.kategori', 'cabang']);

        return view('admin.umpan-balik.show', compact('umpanBalik'));
    }

    public function destroy(UmpanBalik $umpanBalik)
    {
        $umpanBalik->delete();

        return redirect()->route('admin.umpan-balik.index')
            ->with('success', 'Umpan balik berhasil dihapus.');
    }
}
