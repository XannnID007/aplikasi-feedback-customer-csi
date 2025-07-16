<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cabang;

class CabangController extends Controller
{
    public function index()
    {
        $cabang = Cabang::urutan()->paginate(10);
        return view('admin.cabang.index', compact('cabang'));
    }

    public function create()
    {
        return view('admin.cabang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_cabang' => 'required|string|max:255|unique:cabang',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'jam_operasional' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
            'status_aktif' => 'boolean'
        ]);

        Cabang::create([
            'nama_cabang' => $request->nama_cabang,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'jam_operasional' => $request->jam_operasional,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan,
            'status_aktif' => $request->has('status_aktif')
        ]);

        return redirect()->route('admin.cabang.index')
            ->with('success', 'Cabang berhasil ditambahkan.');
    }

    public function show(Cabang $cabang)
    {
        $cabang->load(['umpanBalik' => function ($query) {
            $query->orderBy('created_at', 'desc')->limit(10);
        }]);

        $statistik = [
            'total_feedback' => $cabang->umpanBalik()->count(),
            'feedback_bulan_ini' => $cabang->umpanBalik()->whereMonth('created_at', now()->month)->count(),
            'rata_rating' => $cabang->umpanBalik()->avg('rating_keseluruhan'),
        ];

        return view('admin.cabang.show', compact('cabang', 'statistik'));
    }

    public function edit(Cabang $cabang)
    {
        return view('admin.cabang.edit', compact('cabang'));
    }

    public function update(Request $request, Cabang $cabang)
    {
        $request->validate([
            'nama_cabang' => 'required|string|max:255|unique:cabang,nama_cabang,' . $cabang->id,
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'jam_operasional' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
            'status_aktif' => 'boolean'
        ]);

        $cabang->update([
            'nama_cabang' => $request->nama_cabang,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'jam_operasional' => $request->jam_operasional,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan,
            'status_aktif' => $request->has('status_aktif')
        ]);

        return redirect()->route('admin.cabang.index')
            ->with('success', 'Cabang berhasil diperbarui.');
    }

    public function destroy(Cabang $cabang)
    {
        if ($cabang->umpanBalik()->count() > 0) {
            return redirect()->route('admin.cabang.index')
                ->with('error', 'Cabang tidak dapat dihapus karena masih memiliki feedback.');
        }

        $cabang->delete();

        return redirect()->route('admin.cabang.index')
            ->with('success', 'Cabang berhasil dihapus.');
    }
}
