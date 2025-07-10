@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-16 lg:py-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 bg-gradient-to-br from-maroon-50/50 via-white to-orange-50/30"></div>

        <!-- Simple Decorative Elements -->
        <div class="absolute top-20 right-20 w-32 h-32 bg-maroon-100/20 rounded-full blur-2xl"></div>
        <div class="absolute bottom-10 left-10 w-24 h-24 bg-orange-100/30 rounded-full blur-xl"></div>

        <!-- Main Content -->
        <div class="relative max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center px-4 lg:px-8">

                <!-- Left Side - Content -->
                <div class="text-center lg:text-left px-4 lg:px-0">
                    <!-- Welcome Badge -->

                    <!-- Main Heading -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Welcome To
                        <span class="text-maroon-700">Dimsum BOS!!!</span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-lg md:text-xl text-gray-600 mb-8 leading-relaxed">
                        Bantu kami meningkatkan layanan dengan memberikan
                        <span class="font-medium text-maroon-700">umpan balik berkualitas</span>
                        tentang pengalaman dining istimewa Anda.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 lg:justify-start justify-center mb-8">
                        <a href="{{ route('feedback.form') }}"
                            class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-maroon-700 hover:bg-maroon-800 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Give Feedback
                        </a>
                    </div>

                    <!-- Quick Stats -->
                    <div class="flex flex-wrap gap-6 justify-center lg:justify-start text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            2 menit pengisian
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Data terlindungi
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-maroon-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Respon cepat
                        </div>
                    </div>
                </div>

                <!-- Right Side - Image -->
                <div class="flex justify-center lg:justify-center px-4 lg:px-0">
                    <div class="relative">
                        <!-- Main Image Container -->
                        <div class="relative w-80 h-80 lg:w-96 lg:h-96 rounded-3xl shadow-2xl overflow-hidden">
                            <!-- Main Image -->
                            <img src="{{ asset('images/dimsum.jpeg') }}" alt="Dimsum BOS Restaurant - Customer Feedback"
                                class="w-full h-full object-cover">

                            <!-- Optional: Overlay for better text readability if needed -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Cards Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Kami Butuh Feedback Anda?
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kami telah merancang pengalaman umpan balik yang mudah, aman, dan efektif untuk Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div
                    class="group text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-maroon-100 text-maroon-700 rounded-2xl mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Mudah & Cepat</h3>
                    <p class="text-gray-600">Hanya membutuhkan 2-3 menit untuk memberikan penilaian yang bermakna</p>
                </div>

                <!-- Card 2 -->
                <div
                    class="group text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 text-orange-600 rounded-2xl mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Respon Cepat</h3>
                    <p class="text-gray-600">Masukan Anda akan langsung ditindaklanjuti oleh tim ahli kami</p>
                </div>

                <!-- Card 3 -->
                <div
                    class="group text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-red-100 text-red-600 rounded-2xl mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Kepuasan Anda</h3>
                    <p class="text-gray-600">Tujuan utama kami adalah memberikan pengalaman dining terbaik</p>
                </div>
            </div>
        </div>
    </section>
@endsection
