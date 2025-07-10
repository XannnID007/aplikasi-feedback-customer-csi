@extends('layouts.admin')

@section('title', 'Detail Pertanyaan')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Pertanyaan</h1>
                <p class="text-gray-600 mt-1">Kategori: {{ $pertanyaan->kategori->nama_kategori }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.pertanyaan.edit', $pertanyaan) }}"
                    class="px-4 py-2 bg-maroon-700 text-white rounded-lg hover:bg-maroon-800 transition-colors">
                    Edit Pertanyaan
                </a>
                <a href="{{ route('admin.pertanyaan.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Question Details -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Informasi Pertanyaan</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-maroon-100 text-maroon-800">
                        {{ $pertanyaan->kategori->nama_kategori }}
                    </span>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Pertanyaan</label>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                    {{ $pertanyaan->tipe_pertanyaan == 'rating'
                        ? 'bg-blue-100 text-blue-800'
                        : ($pertanyaan->tipe_pertanyaan == 'teks'
                            ? 'bg-green-100 text-green-800'
                            : 'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst($pertanyaan->tipe_pertanyaan) }}
                    </span>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                    <span
                        class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">
                        {{ $pertanyaan->urutan }}
                    </span>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <div class="flex space-x-2">
                        @if ($pertanyaan->status_aktif)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                Tidak Aktif
                            </span>
                        @endif

                        @if ($pertanyaan->wajib_diisi)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                Wajib Diisi
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                Opsional
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Teks Pertanyaan</label>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-900 text-lg">{{ $pertanyaan->teks_pertanyaan }}</p>
                </div>
            </div>

            @if ($pertanyaan->tipe_pertanyaan == 'pilihan_ganda' && $pertanyaan->pilihan_jawaban)
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-4">Pilihan Jawaban</label>
                    <div class="space-y-3">
                        @foreach ($pertanyaan->pilihan_jawaban as $index => $pilihan)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <span
                                    class="w-8 h-8 bg-maroon-100 text-maroon-800 rounded-full flex items-center justify-center text-sm font-medium mr-3">
                                    {{ chr(65 + $index) }}
                                </span>
                                <span class="text-gray-900">{{ $pilihan }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Question Preview -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Preview Pertanyaan</h2>
            <div class="bg-gray-50 p-6 rounded-lg">
                <label class="block text-sm font-medium text-gray-900 mb-4">
                    {{ $pertanyaan->teks_pertanyaan }}
                    @if ($pertanyaan->wajib_diisi)
                        <span class="text-red-500">*</span>
                    @endif
                </label>

                @if ($pertanyaan->tipe_pertanyaan == 'rating')
                    <div class="flex items-center space-x-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="flex flex-col items-center cursor-pointer group">
                                <div
                                    class="w-12 h-12 rounded-full border-2 border-gray-300 flex items-center justify-center text-lg font-semibold text-gray-500">
                                    {{ $i }}
                                </div>
                                <span class="text-xs text-gray-500 mt-1 text-center">
                                    @switch($i)
                                        @case(1)
                                            Sangat Buruk
                                        @break

                                        @case(2)
                                            Buruk
                                        @break

                                        @case(3)
                                            Cukup
                                        @break

                                        @case(4)
                                            Baik
                                        @break

                                        @case(5)
                                            Sangat Baik
                                        @break
                                    @endswitch
                                </span>
                            </label>
                        @endfor
                    </div>
                @elseif($pertanyaan->tipe_pertanyaan == 'teks')
                    <textarea rows="3" disabled class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white"
                        placeholder="Area untuk jawaban teks..."></textarea>
                @elseif($pertanyaan->tipe_pertanyaan == 'pilihan_ganda')
                    <div class="space-y-2">
                        @foreach ($pertanyaan->pilihan_jawaban as $index => $pilihan)
                            <label class="flex items-center">
                                <input type="radio" disabled class="h-4 w-4 text-maroon-600 mr-3">
                                <span>{{ $pilihan }}</span>
                            </label>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
