@extends('layouts.public')

@section('title', 'Terima Kasih')

@section('content')
    <div class="py-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Success Icon -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-8">
                <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <!-- Success Message -->
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Terima Kasih!
            </h1>

            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Umpan balik Anda telah berhasil dikirim dan sangat berarti bagi kami.
                Masukan Anda akan membantu Dimsum BOS untuk terus meningkatkan kualitas layanan.
            </p>

            <!-- What Happens Next -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 text-left">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Apa yang Terjadi Selanjutnya?</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 bg-maroon-100 text-maroon-700 rounded-full text-xl font-bold mb-4">
                            1
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Analisis</h3>
                        <p class="text-gray-600 text-sm">
                            Tim manajemen akan menganalisis semua feedback yang masuk secara berkala
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 bg-maroon-100 text-maroon-700 rounded-full text-xl font-bold mb-4">
                            2
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Evaluasi</h3>
                        <p class="text-gray-600 text-sm">
                            Kami akan mengevaluasi area yang perlu diperbaiki berdasarkan masukan pelanggan
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 bg-maroon-100 text-maroon-700 rounded-full text-xl font-bold mb-4">
                            3
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Perbaikan</h3>
                        <p class="text-gray-600 text-sm">
                            Implementasi perbaikan layanan untuk pengalaman yang lebih baik
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-maroon-700 hover:bg-maroon-800 rounded-xl transition-colors transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Kembali ke Beranda
                </a>

                <a href="{{ route('feedback.form') }}"
                    class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-maroon-700 bg-white hover:bg-maroon-50 rounded-xl border-2 border-maroon-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    Berikan Feedback Lagi
                </a>
            </div>

            <!-- Additional Info -->
            <div class="bg-maroon-50 rounded-xl p-6 border border-maroon-200">
                <h3 class="text-lg font-semibold text-maroon-900 mb-3">Tetap Terhubung dengan Kami</h3>
                <p class="text-maroon-700 mb-4">
                    Ikuti media sosial kami untuk mendapatkan update terbaru tentang menu, promo, dan peningkatan layanan
                    berdasarkan feedback pelanggan.
                </p>

                <div class="flex justify-center space-x-4">
                    <a href="#"
                        class="inline-flex items-center px-4 py-2 bg-white text-maroon-700 rounded-lg border border-maroon-300 hover:bg-maroon-100 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg>
                        Twitter
                    </a>

                    <a href="#"
                        class="inline-flex items-center px-4 py-2 bg-white text-maroon-700 rounded-lg border border-maroon-300 hover:bg-maroon-100 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.097.118.112.221.085.342-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.747 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001 12.017.001z" />
                        </svg>
                        Instagram
                    </a>

                    <a href="#"
                        class="inline-flex items-center px-4 py-2 bg-white text-maroon-700 rounded-lg border border-maroon-300 hover:bg-maroon-100 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 01-1.93.07 4.28 4.28 0 004 2.98 8.521 8.521 0 01-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                        </svg>
                        Facebook
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
