<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UmpanBalik;
use App\Models\DetailUmpanBalik;
use App\Models\Pertanyaan;
use App\Models\Cabang;
use Illuminate\Support\Facades\DB;

class UmpanBalikController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cabang_id' => 'required|exists:cabang,id',
            'tanggal_kunjungan' => 'required|date',
            'nama_pelanggan' => 'nullable|string|max:255',
            'email_pelanggan' => 'nullable|email|max:255',
            'telepon_pelanggan' => 'nullable|string|max:20',
            'komentar_umum' => 'nullable|string',
            'rating.*' => 'required|integer|min:1|max:5',
        ]);

        DB::transaction(function () use ($request) {
            // Simpan data umpan balik utama
            $umpanBalik = UmpanBalik::create([
                'cabang_id' => $request->cabang_id,
                'nama_pelanggan' => $request->nama_pelanggan,
                'email_pelanggan' => $request->email_pelanggan,
                'telepon_pelanggan' => $request->telepon_pelanggan,
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'komentar_umum' => $request->komentar_umum,
                'rating_keseluruhan' => collect($request->rating)->avg(),
            ]);

            // Simpan detail jawaban
            foreach ($request->rating as $pertanyaanId => $rating) {
                DetailUmpanBalik::create([
                    'umpan_balik_id' => $umpanBalik->id,
                    'pertanyaan_id' => $pertanyaanId,
                    'nilai_rating' => $rating,
                ]);
            }
        });

        return redirect()->route('feedback.sukses')
            ->with('success', 'Terima kasih! Umpan balik Anda telah berhasil disimpan.');
    }

    public function sukses()
    {
        return view('feedback.sukses');
    }
}
