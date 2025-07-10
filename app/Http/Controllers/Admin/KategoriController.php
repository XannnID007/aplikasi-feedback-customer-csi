<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriPenilaian;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = KategoriPenilaian::orderBy('nama_kategori')->paginate(10);
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_penilaian',
            'keterangan' => 'nullable|string',
            'bobot' => 'required|integer|min:1|max:10',
            'status_aktif' => 'boolean'
        ]);

        KategoriPenilaian::create([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
            'bobot' => $request->bobot,
            'status_aktif' => $request->has('status_aktif')
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(KategoriPenilaian $kategori)
    {
        $kategori->load('pertanyaan');
        return view('admin.kategori.show', compact('kategori'));
    }

    public function edit(KategoriPenilaian $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriPenilaian $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_penilaian,nama_kategori,' . $kategori->id,
            'keterangan' => 'nullable|string',
            'bobot' => 'required|integer|min:1|max:10',
            'status_aktif' => 'boolean'
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
            'bobot' => $request->bobot,
            'status_aktif' => $request->has('status_aktif')
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriPenilaian $kategori)
    {
        if ($kategori->pertanyaan()->count() > 0) {
            return redirect()->route('admin.kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki pertanyaan.');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
