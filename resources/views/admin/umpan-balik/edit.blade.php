@extends('layouts.admin')

@section('title', 'Edit Umpan Balik')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Umpan Balik</h1>
                <p class="text-gray-600 mt-1">Edit data umpan balik pelanggan: {{ $umpanBalik->nama_pelanggan ?? 'Anonim' }}
                </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.umpan-balik.show', $umpanBalik) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Lihat Detail
                </a>
                <a href="{{ route('admin.umpan-balik.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Warning -->
        <div class="bg-orange-50 rounded-xl p-4 border border-orange-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-orange-800">
                        Peringatan
                    </h3>
                    <div class="mt-2 text-sm text-orange-700">
                        <p>Mengubah data umpan balik dapat mempengaruhi perhitungan CSI. Pastikan perubahan yang dilakukan
                            sudah benar dan diperlukan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <form action="{{ route('admin.umpan-balik.update', $umpanBalik) }}" method="POST" class="space-y-6"
                x-data="feedbackForm()">
                @csrf
                @method('PUT')

                <!-- Customer Info -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pelanggan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                Pelanggan</label>
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                                value="{{ old('nama_pelanggan', $umpanBalik->nama_pelanggan) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('nama_pelanggan') border-red-500 @enderror">
                            @error('nama_pelanggan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email_pelanggan" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email_pelanggan" name="email_pelanggan"
                                value="{{ old('email_pelanggan', $umpanBalik->email_pelanggan) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('email_pelanggan') border-red-500 @enderror">
                            @error('email_pelanggan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="telepon_pelanggan" class="block text-sm font-medium text-gray-700 mb-2">No.
                                Telepon</label>
                            <input type="tel" id="telepon_pelanggan" name="telepon_pelanggan"
                                value="{{ old('telepon_pelanggan', $umpanBalik->telepon_pelanggan) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('telepon_pelanggan') border-red-500 @enderror">
                            @error('telepon_pelanggan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Kunjungan <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" required
                                value="{{ old('tanggal_kunjungan', $umpanBalik->tanggal_kunjungan->format('Y-m-d')) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('tanggal_kunjungan') border-red-500 @enderror"
                                max="{{ date('Y-m-d') }}">
                            @error('tanggal_kunjungan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Existing Ratings -->
                @php
                    $existingRatings = $umpanBalik->detailUmpanBalik->pluck('nilai_rating', 'pertanyaan_id')->toArray();
                @endphp

                @foreach ($kategori as $kat)
                    <div class="border-b border-gray-200 pb-6 last:border-b-0">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $kat->nama_kategori }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $kat->keterangan }}</p>

                        <div class="space-y-4">
                            @foreach ($kat->pertanyaan as $pertanyaan)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-900 mb-3">
                                        {{ $pertanyaan->teks_pertanyaan }}
                                        @if ($pertanyaan->wajib_diisi)
                                            <span class="text-red-500">*</span>
                                        @endif
                                    </label>

                                    <div class="flex items-center space-x-4">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <label class="flex flex-col items-center cursor-pointer group">
                                                <input type="radio" name="rating[{{ $pertanyaan->id }}]"
                                                    value="{{ $i }}"
                                                    {{ $pertanyaan->wajib_diisi ? 'required' : '' }}
                                                    {{ old("rating.{$pertanyaan->id}", $existingRatings[$pertanyaan->id] ?? null) == $i ? 'checked' : '' }}
                                                    class="sr-only" x-model="ratings[{{ $pertanyaan->id }}]">
                                                <div class="flex flex-col items-center">
                                                    <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center text-sm font-semibold transition-all duration-200"
                                                        :class="ratings[{{ $pertanyaan->id }}] == {{ $i }} ?
                                                            'bg-maroon-700 border-maroon-700 text-white transform scale-110' :
                                                            'border-gray-300 text-gray-500 group-hover:border-maroon-400 group-hover:text-maroon-600'">
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
                                                </div>
                                            </label>
                                        @endfor
                                    </div>

                                    @error("rating.{$pertanyaan->id}")
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- General Comment -->
                <div>
                    <label for="komentar_umum" class="block text-sm font-medium text-gray-700 mb-2">
                        Komentar atau Saran Tambahan
                    </label>
                    <textarea id="komentar_umum" name="komentar_umum" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('komentar_umum') border-red-500 @enderror"
                        placeholder="Komentar, saran, atau keluhan tambahan (opsional)">{{ old('komentar_umum') }}</textarea>
                    @error('komentar_umum')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6">
                    <a href="{{ route('admin.umpan-balik.index') }}"
                        class="px-6 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors text-center">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-2 bg-maroon-700 hover:bg-maroon-800 text-white font-medium rounded-lg transition-colors">
                        Simpan Umpan Balik
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function feedbackForm() {
            return {
                ratings: @json(old('rating', [])),
            }
        }
    </script>
@endsection
