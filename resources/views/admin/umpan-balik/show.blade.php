@extends('layouts.admin')

@section('title', 'Detail Umpan Balik')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Umpan Balik</h1>
                <p class="text-gray-600 mt-1">{{ $umpanBalik->created_at->format('d F Y, H:i') }}</p>
            </div>
            <a href="{{ route('admin.umpan-balik.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali
            </a>
        </div>

        <!-- Cabang Info -->
        @if ($umpanBalik->cabang)
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Cabang</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Cabang</label>
                        <p class="mt-1 text-lg font-semibold text-maroon-700">{{ $umpanBalik->cabang->nama_cabang }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $umpanBalik->cabang->alamat }}</p>
                    </div>

                    @if ($umpanBalik->cabang->telepon)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telepon</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $umpanBalik->cabang->telepon }}</p>
                        </div>
                    @endif

                    @if ($umpanBalik->cabang->jam_operasional)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jam Operasional</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $umpanBalik->cabang->jam_operasional }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Customer Info -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pelanggan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $umpanBalik->nama_pelanggan ?? 'Anonim' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $umpanBalik->email_pelanggan ?? '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $umpanBalik->telepon_pelanggan ?? '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $umpanBalik->tanggal_kunjungan->format('d F Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Rating Overview -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Rating Keseluruhan</h2>
            <div class="flex items-center">
                <span
                    class="text-3xl font-bold text-maroon-700 mr-4">{{ number_format($umpanBalik->rating_keseluruhan, 1) }}</span>
                <div class="flex items-center">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-6 h-6 {{ $i <= $umpanBalik->rating_keseluruhan ? 'text-yellow-400' : 'text-gray-300' }}"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Detailed Ratings -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Penilaian Detail</h2>

            @php
                $groupedDetails = $umpanBalik->detailUmpanBalik->groupBy('pertanyaan.kategori.nama_kategori');
            @endphp

            @foreach ($groupedDetails as $kategoriNama => $details)
                <div class="mb-8 last:mb-0">
                    <h3 class="text-md font-semibold text-gray-800 mb-4 border-l-4 border-maroon-500 pl-3">
                        {{ $kategoriNama }}
                    </h3>

                    <div class="space-y-4">
                        @foreach ($details as $detail)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-sm font-medium text-gray-700 mb-2">
                                    {{ $detail->pertanyaan->teks_pertanyaan }}
                                </p>
                                <div class="flex items-center">
                                    <span
                                        class="text-lg font-bold text-maroon-700 mr-3">{{ $detail->nilai_rating }}/5</span>
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $detail->nilai_rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- General Comment -->
        @if ($umpanBalik->komentar_umum)
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Komentar Umum</h2>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700">{{ $umpanBalik->komentar_umum }}</p>
                </div>
            </div>
        @endif
    </div>
@endsection
