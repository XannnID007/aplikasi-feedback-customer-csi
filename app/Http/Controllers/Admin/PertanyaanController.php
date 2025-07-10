<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\KategoriPenilaian;

class PertanyaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pertanyaan::with('kategori')->orderBy('kategori_id')->orderBy('urutan');

        if ($request->has('kategori_id') && $request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $pertanyaan = $query->paginate(15);
        $kategori = KategoriPenilaian::aktif()->get();

        return view('admin.pertanyaan.index', compact('pertanyaan', 'kategori'));
    }

    public function create()
    {
        $kategori = KategoriPenilaian::aktif()->get();
        return view('admin.pertanyaan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_penilaian,id',
            'teks_pertanyaan' => 'required|string',
            'tipe_pertanyaan' => 'required|in:rating,teks,pilihan_ganda',
            'pilihan_jawaban' => 'nullable|array',
            'urutan' => 'required|integer|min:1',
            'wajib_diisi' => 'boolean',
            'status_aktif' => 'boolean'
        ]);

        Pertanyaan::create([
            'kategori_id' => $request->kategori_id,
            'teks_pertanyaan' => $request->teks_pertanyaan,
            'tipe_pertanyaan' => $request->tipe_pertanyaan,
            'pilihan_jawaban' => $request->pilihan_jawaban,
            'urutan' => $request->urutan,
            'wajib_diisi' => $request->has('wajib_diisi'),
            'status_aktif' => $request->has('status_aktif')
        ]);

        return redirect()->route('admin.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function show(Pertanyaan $pertanyaan)
    {
        $pertanyaan->load('kategori');
        return view('admin.pertanyaan.show', compact('pertanyaan'));
    }

    public function edit(Pertanyaan $pertanyaan)
    {
        $kategori = KategoriPenilaian::aktif()->get();
        return view('admin.pertanyaan.edit', compact('pertanyaan', 'kategori'));
    }

    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_penilaian,id',
            'teks_pertanyaan' => 'required|string',
            'tipe_pertanyaan' => 'required|in:rating,teks,pilihan_ganda',
            'pilihan_jawaban' => 'nullable|array',
            'urutan' => 'required|integer|min:1',
            'wajib_diisi' => 'boolean',
            'status_aktif' => 'boolean'
        ]);

        $pertanyaan->update([
            'kategori_id' => $request->kategori_id,
            'teks_pertanyaan' => $request->teks_pertanyaan,
            'tipe_pertanyaan' => $request->tipe_pertanyaan,
            'pilihan_jawaban' => $request->pilihan_jawaban,
            'urutan' => $request->urutan,
            'wajib_diisi' => $request->has('wajib_diisi'),
            'status_aktif' => $request->has('status_aktif')
        ]);

        return redirect()->route('admin.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroy(Pertanyaan $pertanyaan)
    {
        if ($pertanyaan->detailUmpanBalik()->count() > 0) {
            return redirect()->route('admin.pertanyaan.index')
                ->with('error', 'Pertanyaan tidak dapat dihapus karena sudah ada jawaban dari pelanggan.');
        }

        $pertanyaan->delete();

        return redirect()->route('admin.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
