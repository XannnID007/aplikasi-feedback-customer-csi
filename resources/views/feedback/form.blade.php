@extends('layouts.public')

@section('title', 'Berikan Umpan Balik')

@section('content')
    <div class="py-8 lg:py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-maroon-600 to-maroon-700 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m10 0v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8m10 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2" />
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                    Berikan Umpan Balik Anda
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Kami sangat menghargai pendapat Anda tentang pengalaman dining di Dimsum BOS.
                    Masukan Anda akan membantu kami memberikan layanan yang lebih baik.
                </p>
            </div>

            <!-- Main Form Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                <!-- Header Card -->
                <div class="bg-gradient-to-r from-maroon-700 via-maroon-600 to-maroon-700 px-6 sm:px-8 py-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-2">Form Penilaian Layanan</h2>
                            <p class="text-maroon-100 text-sm">
                                Mohon berikan penilaian pada skala 1-5 (1 = Sangat Tidak Puas, 5 = Sangat Puas)
                            </p>
                        </div>
                        <div class="hidden sm:block">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('feedback.store') }}" method="POST" class="p-6 sm:p-8" x-data="feedbackForm()">
                    @csrf

                    <!-- Progress Indicator -->
                    <div class="mb-8">
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

                    <!-- Customer Information -->
                    <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-maroon-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-maroon-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Informasi Pelanggan</h3>
                            <span class="ml-2 text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">Opsional</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">
                                    Nama Lengkap
                                </label>
                                <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 transition-all duration-200 hover:border-gray-400"
                                    placeholder="Masukkan nama lengkap Anda">
                            </div>

                            <div class="space-y-2">
                                <label for="email_pelanggan" class="block text-sm font-medium text-gray-700">
                                    Alamat Email
                                </label>
                                <input type="email" id="email_pelanggan" name="email_pelanggan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 transition-all duration-200 hover:border-gray-400"
                                    placeholder="email@example.com">
                            </div>

                            <div class="space-y-2">
                                <label for="telepon_pelanggan" class="block text-sm font-medium text-gray-700">
                                    Nomor Telepon
                                </label>
                                <input type="tel" id="telepon_pelanggan" name="telepon_pelanggan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 transition-all duration-200 hover:border-gray-400"
                                    placeholder="08xxxxxxxxxx">
                            </div>

                            <div class="space-y-2">
                                <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700">
                                    Tanggal Kunjungan <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 transition-all duration-200 hover:border-gray-400"
                                    max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Rating Categories -->
                    @foreach ($kategori as $index => $kat)
                        <div class="mb-8">
                            <div
                                class="bg-gradient-to-r from-gray-50 to-gray-50/50 rounded-2xl p-6 sm:p-8 border border-gray-100">
                                <!-- Category Header -->
                                <div class="flex items-start justify-between mb-6">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-maroon-600 rounded-full flex items-center justify-center mr-4 text-white font-bold">
                                            {{ $index + 1 }}
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $kat->nama_kategori }}
                                            </h3>
                                            <p class="text-gray-600 text-sm">{{ $kat->keterangan }}</p>
                                        </div>
                                    </div>
                                    <div class="hidden sm:block">
                                        <div class="w-8 h-8 bg-maroon-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-maroon-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Questions -->
                                <div class="space-y-6">
                                    @foreach ($kat->pertanyaan as $pertanyaan)
                                        <div
                                            class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200">
                                            <div class="flex items-start justify-between mb-4">
                                                <label class="block text-sm font-medium text-gray-900 pr-4">
                                                    {{ $pertanyaan->teks_pertanyaan }}
                                                    @if ($pertanyaan->wajib_diisi)
                                                        <span class="text-red-500 ml-1">*</span>
                                                    @endif
                                                </label>
                                                <div
                                                    class="flex items-center text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded-full">
                                                    <span x-show="ratings[{{ $pertanyaan->id }}]" class="text-maroon-600">
                                                        ✓ Selesai
                                                    </span>
                                                    <span x-show="!ratings[{{ $pertanyaan->id }}]">
                                                        Belum dinilai
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-between space-x-2 sm:space-x-4">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <label class="flex flex-col items-center cursor-pointer group flex-1">
                                                        <input type="radio" name="rating[{{ $pertanyaan->id }}]"
                                                            value="{{ $i }}"
                                                            {{ $pertanyaan->wajib_diisi ? 'required' : '' }}
                                                            class="sr-only" x-model="ratings[{{ $pertanyaan->id }}]">
                                                        <div class="flex flex-col items-center w-full">
                                                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border-2 flex items-center justify-center text-sm sm:text-lg font-semibold transition-all duration-200 mb-2"
                                                                :class="ratings[{{ $pertanyaan->id }}] ==
                                                                    {{ $i }} ?
                                                                    'bg-maroon-700 border-maroon-700 text-white transform scale-110 shadow-lg' :
                                                                    'border-gray-300 text-gray-500 group-hover:border-maroon-400 group-hover:text-maroon-600 group-hover:scale-105'">
                                                                {{ $i }}
                                                            </div>
                                                            <span class="text-xs text-gray-500 text-center leading-tight">
                                                                @switch($i)
                                                                    @case(1)
                                                                        Sangat<br>Buruk
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
                                                                        Sangat<br>Baik
                                                                    @break
                                                                @endswitch
                                                            </span>
                                                        </div>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- General Comments -->
                    <div class="mb-8">
                        <div
                            class="bg-gradient-to-r from-gray-50 to-gray-50/50 rounded-2xl p-6 sm:p-8 border border-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-maroon-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-maroon-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <label for="komentar_umum" class="block text-lg font-semibold text-gray-900">
                                    Komentar atau Saran Tambahan
                                </label>
                            </div>
                            <textarea id="komentar_umum" name="komentar_umum" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 transition-all duration-200 hover:border-gray-400 resize-none"
                                placeholder="Bagikan pengalaman, saran, atau keluhan Anda di sini... (opsional)"></textarea>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6 border-t border-gray-100">
                        <a href="{{ route('home') }}"
                            class="px-6 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl font-medium transition-all duration-200 text-center hover:shadow-md">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali
                            </span>
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-maroon-700 to-maroon-600 hover:from-maroon-800 hover:to-maroon-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Kirim Umpan Balik
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Trust Indicators -->
            <div class="mt-8 text-center">
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
                    // Set default date to today
                    document.getElementById('tanggal_kunjungan').value = new Date().toISOString().split('T')[0];

                    // Auto-save progress to localStorage (optional)
                    this.$watch('ratings', (value) => {
                        // console.log('Progress:', Object.keys(value).length, 'questions answered');
                    });
                },

                getProgressPercentage() {
                    const totalQuestions = {{ $kategori->sum(function ($k) {return $k->pertanyaan->count();}) }};
                    const answeredQuestions = Object.keys(this.ratings).length;
                    return Math.round((answeredQuestions / totalQuestions) * 100);
                }
            }
        }

        // Smooth scroll to first unanswered question
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const requiredInputs = form.querySelectorAll('input[required]:not([type="hidden"])');
                for (let input of requiredInputs) {
                    if (!input.value) {
                        e.preventDefault();
                        input.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        input.focus();
                        break;
                    }
                }
            });
        });
    </script>
@endsection
