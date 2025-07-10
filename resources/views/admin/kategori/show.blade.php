@extends('layouts.admin')

@section('title', 'Detail Kategori')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Kategori: {{ $kategori->nama_kategori }}</h1>
                <p class="text-gray-600 mt-1">Informasi lengkap kategori penilaian dan pertanyaan terkait</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.kategori.edit', $kategori) }}"
                    class="px-4 py-2 bg-maroon-700 text-white rounded-lg hover:bg-maroon-800 transition-colors">
                    Edit Kategori
                </a>
                <a href="{{ route('admin.kategori.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Category Info -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Informasi Kategori</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $kategori->nama_kategori }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <p class="text-sm text-gray-600 font-mono bg-gray-100 px-3 py-2 rounded">{{ $kategori->slug }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bobot</label>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-maroon-100 text-maroon-800">
                        {{ $kategori->bobot }}
                    </span>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    @if ($kategori->status_aktif)
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Aktif
                        </span>
                    @else
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Tidak Aktif
                        </span>
                    @endif
                </div>

                @if ($kategori->keterangan)
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $kategori->keterangan }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Questions List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">
                    Daftar Pertanyaan ({{ $kategori->pertanyaan->count() }})
                </h2>
                <a href="{{ route('admin.pertanyaan.create') }}?kategori_id={{ $kategori->id }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                    Tambah Pertanyaan
                </a>
            </div>

            @if ($kategori->pertanyaan->count() > 0)
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($kategori->pertanyaan->sortBy('urutan') as $pertanyaan)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3 mb-2">
                                            <span
                                                class="inline-flex items-center justify-center w-6 h-6 bg-maroon-100 text-maroon-800 text-xs font-medium rounded-full">
                                                {{ $pertanyaan->urutan }}
                                            </span>
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium 
                                    {{ $pertanyaan->tipe_pertanyaan == 'rating'
                                        ? 'bg-blue-100 text-blue-800'
                                        : ($pertanyaan->tipe_pertanyaan == 'teks'
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($pertanyaan->tipe_pertanyaan) }}
                                            </span>
                                            @if ($pertanyaan->wajib_diisi)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800">
                                                    Wajib
                                                </span>
                                            @endif
                                            @if ($pertanyaan->status_aktif)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                                    Aktif
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800">
                                                    Tidak Aktif
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-gray-900 font-medium">{{ $pertanyaan->teks_pertanyaan }}</p>

                                        @if ($pertanyaan->tipe_pertanyaan == 'pilihan_ganda' && $pertanyaan->pilihan_jawaban)
                                            <div class="mt-3">
                                                <p class="text-sm text-gray-600 mb-2">Pilihan jawaban:</p>
                                                <ul class="text-sm text-gray-700 space-y-1">
                                                    @foreach ($pertanyaan->pilihan_jawaban as $index => $pilihan)
                                                        <li class="flex items-center">
                                                            <span
                                                                class="w-5 h-5 bg-gray-200 rounded-full flex items-center justify-center text-xs font-medium mr-2">
                                                                {{ chr(65 + $index) }}
                                                            </span>
                                                            {{ $pilihan }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex space-x-2 ml-4">
                                        <a href="{{ route('admin.pertanyaan.edit', $pertanyaan) }}"
                                            class="text-maroon-600 hover:text-maroon-800 text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.pertanyaan.destroy', $pertanyaan) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus pertanyaan ini?')"
                                                class="text-red-600 hover:text-red-800 text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <p class="text-gray-500 mb-4">Belum ada pertanyaan dalam kategori ini</p>
                    <a href="{{ route('admin.pertanyaan.create') }}?kategori_id={{ $kategori->id }}"
                        class="text-maroon-600 hover:text-maroon-700 font-medium">
                        Tambah pertanyaan pertama
                    </a>
                </div>
            @endif
        </div>

        <!-- Statistics -->
        @if ($kategori->pertanyaan->count() > 0)
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistik Kategori</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-maroon-700">{{ $kategori->pertanyaan->count() }}</div>
                        <div class="text-sm text-gray-600">Total Pertanyaan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-700">
                            {{ $kategori->pertanyaan->where('status_aktif', true)->count() }}</div>
                        <div class="text-sm text-gray-600">Pertanyaan Aktif</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-700">
                            {{ $kategori->pertanyaan->where('wajib_diisi', true)->count() }}</div>
                        <div class="text-sm text-gray-600">Pertanyaan Wajib</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-orange-700">{{ $kategori->bobot }}</div>
                        <div class="text-sm text-gray-600">Bobot CSI</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
