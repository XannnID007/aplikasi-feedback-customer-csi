@extends('layouts.public')

@section('title', 'Berikan Umpan Balik')

@section('content')
    <div class="py-6 lg:py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-maroon-600 to-maroon-700 rounded-full mb-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m10 0v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8m10 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2" />
                    </svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Berikan Umpan Balik Anda</h1>
                <p class="text-gray-600 max-w-xl mx-auto">Bantu kami meningkatkan layanan dengan feedback Anda</p>
            </div>

            <!-- Main Form -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-maroon-700 to-maroon-600 px-6 py-4 rounded-t-2xl">
                    <h2 class="text-lg font-semibold text-white">Form Penilaian Layanan</h2>
                    <p class="text-maroon-100 text-sm">Skala 1-5 (1 = Sangat Tidak Puas, 5 = Sangat Puas)</p>
                </div>

                <form action="{{ route('feedback.store') }}" method="POST" class="p-6" x-data="feedbackForm()">
                    @csrf

                    <!-- Progress Bar -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                            <span>Progress</span>
                            <span
                                x-text="Math.round((Object.keys(ratings).length / {{ $kategori->sum(function ($k) {return $k->pertanyaan->count();}) }}) * 100) + '%'"></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 h-2 rounded-full transition-all duration-300"
                                :style="'width: ' + Math.round((Object.keys(ratings).length /
                                        {{ $kategori->sum(function ($k) {return $k->pertanyaan->count();}) }}) *
                                    100) + '%'">
                            </div>
                        </div>
                    </div>

                    <!-- Cabang Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-maroon-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Pilih Cabang <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <select name="cabang_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('cabang_id') border-red-500 @enderror">
                            <option value="">-- Pilih Cabang --</option>
                            @foreach ($cabang as $branch)
                                <option value="{{ $branch->id }}" {{ old('cabang_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->nama_cabang }}
                                </option>
                            @endforeach
                        </select>
                        @error('cabang_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Customer Info in Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                                value="{{ old('nama_pelanggan') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('nama_pelanggan') border-red-500 @enderror"
                                placeholder="Nama Anda (opsional)">
                        </div>
                        <div>
                            <label for="email_pelanggan" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email_pelanggan" name="email_pelanggan"
                                value="{{ old('email_pelanggan') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('email_pelanggan') border-red-500 @enderror"
                                placeholder="email@example.com (opsional)">
                        </div>
                        <div>
                            <label for="telepon_pelanggan" class="block text-sm font-medium text-gray-700 mb-1">No.
                                HP</label>
                            <input type="tel" id="telepon_pelanggan" name="telepon_pelanggan"
                                value="{{ old('telepon_pelanggan') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('telepon_pelanggan') border-red-500 @enderror"
                                placeholder="08xxxxxxxxxx (opsional)">
                        </div>
                        <div>
                            <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700 mb-1">
                                Tanggal Kunjungan <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" required
                                value="{{ old('tanggal_kunjungan') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('tanggal_kunjungan') border-red-500 @enderror"
                                max="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <!-- Rating Categories - Compact Version -->
                    @foreach ($kategori as $index => $kat)
                        <div class="mb-6">
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                <!-- Category Header - Compact -->
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-8 h-8 bg-maroon-600 rounded-full flex items-center justify-center mr-3 text-white font-bold text-sm">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $kat->nama_kategori }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $kat->keterangan }}</p>
                                    </div>
                                </div>

                                <!-- Questions - Compact Layout -->
                                <div class="space-y-4">
                                    @foreach ($kat->pertanyaan as $pertanyaan)
                                        <div class="bg-white rounded-lg p-4 border border-gray-100">
                                            <div class="flex items-start justify-between mb-3">
                                                <label class="block text-sm font-medium text-gray-900 flex-1 pr-4">
                                                    {{ $pertanyaan->teks_pertanyaan }}
                                                    @if ($pertanyaan->wajib_diisi)
                                                        <span class="text-red-500 ml-1">*</span>
                                                    @endif
                                                </label>
                                                <div class="text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded-full">
                                                    <span x-show="ratings[{{ $pertanyaan->id }}]"
                                                        class="text-maroon-600">✓</span>
                                                    <span x-show="!ratings[{{ $pertanyaan->id }}]">-</span>
                                                </div>
                                            </div>

                                            <!-- Rating Buttons - Compact -->
                                            <div class="flex items-center justify-between space-x-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <label class="flex flex-col items-center cursor-pointer group flex-1">
                                                        <input type="radio" name="rating[{{ $pertanyaan->id }}]"
                                                            value="{{ $i }}"
                                                            {{ $pertanyaan->wajib_diisi ? 'required' : '' }}
                                                            class="sr-only" x-model="ratings[{{ $pertanyaan->id }}]"
                                                            {{ old("rating.{$pertanyaan->id}") == $i ? 'checked' : '' }}>
                                                        <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center text-sm font-semibold transition-all duration-200 mb-1"
                                                            :class="ratings[{{ $pertanyaan->id }}] == {{ $i }} ?
                                                                'bg-maroon-700 border-maroon-700 text-white transform scale-110 shadow-md' :
                                                                'border-gray-300 text-gray-500 group-hover:border-maroon-400 group-hover:text-maroon-600 group-hover:scale-105'">
                                                            {{ $i }}
                                                        </div>
                                                        <span class="text-xs text-gray-500 text-center leading-tight">
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
                                            @error("rating.{$pertanyaan->id}")
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Comments -->
                    <div class="mb-6">
                        <label for="komentar_umum" class="flex items-center text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-maroon-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Komentar atau Saran (Opsional)
                        </label>
                        <textarea id="komentar_umum" name="komentar_umum" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 transition-all duration-200 resize-none @error('komentar_umum') border-red-500 @enderror"
                            placeholder="Bagikan pengalaman, saran, atau keluhan Anda...">{{ old('komentar_umum') }}</textarea>
                        @error('komentar_umum')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4 border-t border-gray-100">
                        <a href="{{ route('home') }}"
                            class="px-6 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors text-center">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali
                            </span>
                        </a>
                        <button type="submit"
                            class="px-8 py-2 bg-gradient-to-r from-maroon-700 to-maroon-600 hover:from-maroon-800 hover:to-maroon-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Kirim Feedback
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Trust Indicators -->
            <div class="mt-6 text-center">
                <div class="flex items-center justify-center space-x-6 text-sm text-gray-500">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Data Aman
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Anonim
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-purple-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        2 Menit
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function feedbackForm() {
            return {
                ratings: {},

                init() {
                    document.getElementById('tanggal_kunjungan').value = new Date().toISOString().split('T')[0];
                },

                getProgressPercentage() {
                    const totalQuestions = {{ $kategori->sum(function ($k) {return $k->pertanyaan->count();}) }};
                    const answeredQuestions = Object.keys(this.ratings).length;
                    return Math.round((answeredQuestions / totalQuestions) * 100);
                }
            }
        }
    </script>
@endsection
