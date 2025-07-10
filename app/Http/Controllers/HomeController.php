<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriPenilaian;
use App\Models\Pertanyaan;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function feedback()
    {
        $kategori = KategoriPenilaian::aktif()
            ->with(['pertanyaan' => function ($query) {
                $query->aktif()->orderBy('urutan');
            }])
            ->get();

        return view('feedback.form', compact('kategori'));
    }
}
