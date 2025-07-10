@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')
    <!-- Hero Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-maroon-50 to-orange-50">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Tentang <span class="text-maroon-700">Dimsum BOS</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Restoran dimsum dengan cita rasa autentik yang mengutamakan kualitas makanan dan kepuasan pelanggan sejak
                2018.
            </p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Cerita Kami</h2>
                    <div class="space-y-4 text-gray-600">
                        <p>
                            Dimsum BOS didirikan pada tahun 2018 dengan visi menjadi restoran dimsum terbaik yang menyajikan
                            kelezatan autentik dengan sentuhan modern. Kami memulai perjalanan dari sebuah warung kecil
                            dengan
                            komitmen tinggi terhadap kualitas.
                        </p>
                        <p>
                            Dengan resep turun temurun yang telah disempurnakan dan bahan-bahan pilihan terbaik, kami terus
                            berinovasi untuk memberikan pengalaman kuliner yang tak terlupakan bagi setiap pelanggan.
                        </p>
                        <p>
                            Kini, Dimsum BOS telah melayani ribuan pelanggan dan terus berkomitmen untuk meningkatkan
                            kualitas
                            layanan melalui sistem umpan balik pelanggan yang komprehensif.
                        </p>
                    </div>
                </div>
                <div class="lg:order-first">
                    <div class="bg-gray-200 rounded-lg h-80 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <p class="text-gray-500">Foto Restoran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Nilai-Nilai Kami</h2>
                <p class="text-xl text-gray-600">Prinsip yang kami pegang dalam melayani pelanggan</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-maroon-100 text-maroon-700 rounded-lg mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Kualitas Terjamin</h3>
                    <p class="text-gray-600">
                        Menggunakan bahan-bahan segar berkualitas tinggi dan proses pembuatan yang higienis untuk
                        memastikan cita rasa terbaik.
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-maroon-100 text-maroon-700 rounded-lg mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Pelayanan Ramah</h3>
                    <p class="text-gray-600">
                        Tim kami dilatih untuk memberikan pelayanan yang hangat dan profesional, membuat setiap
                        kunjungan menjadi pengalaman yang menyenangkan.
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-maroon-100 text-maroon-700 rounded-lg mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Inovasi Berkelanjutan</h3>
                    <p class="text-gray-600">
                        Terus berinovasi dalam menu dan layanan berdasarkan masukan pelanggan untuk memberikan
                        pengalaman kuliner yang selalu fresh.
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
