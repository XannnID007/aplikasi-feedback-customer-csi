@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-gray-600">Panel admin Dimsum BOS</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-medium text-gray-700">{{ date('d F Y') }}</p>
                <p class="text-xs text-gray-500">Update: {{ date('H:i') }}</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Feedback -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3 flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-600 truncate">Total Umpan Balik</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($statistik['total_feedback']) }}</p>
                    </div>
                </div>
            </div>

            <!-- Feedback Bulan Ini -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3 flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-600 truncate">Bulan Ini</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($statistik['feedback_bulan_ini']) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feedback Hari Ini -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-2 bg-orange-100 rounded-lg">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3 flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-600 truncate">Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($statistik['feedback_hari_ini']) }}</p>
                    </div>
                </div>
            </div>

            <!-- Rata-rata Rating -->
            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-2 bg-maroon-100 rounded-lg">
                        <svg class="w-6 h-6 text-maroon-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3 flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-600 truncate">Rata-rata Rating</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $statistik['rata_rating'] ? number_format($statistik['rata_rating'], 1) : '0.0' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CSI Overview -->
        @if ($csiTerbaru['total_responden'] > 0)
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Customer Satisfaction Index (CSI)</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="text-center p-6 bg-gradient-to-br from-maroon-50 to-orange-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-2">Indeks Kepuasan Pelanggan</p>
                        <p class="text-4xl font-bold text-maroon-700">{{ $csiTerbaru['indeks_kepuasan'] }}%</p>
                        <p class="text-lg font-medium text-maroon-600 mt-2">{{ $csiTerbaru['kategori_csi'] }}</p>
                        <p class="text-sm text-gray-500 mt-2">{{ $csiTerbaru['total_responden'] }} responden</p>
                    </div>
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-3">Detail per Kategori</h3>
                        <div class="space-y-2 max-h-48 overflow-y-auto">
                            @foreach ($csiTerbaru['detail_kategori'] as $detail)
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="text-sm font-medium text-gray-700">{{ $detail['nama_kategori'] }}</span>
                                    <div class="text-right">
                                        <span class="text-sm font-bold text-gray-900">{{ $detail['mss'] }}/5.0</span>
                                        <span class="text-xs text-gray-500 block">Bobot: {{ $detail['mis'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.umpan-balik.index') }}"
                class="block p-4 bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Kelola Umpan
                            Balik</h3>
                        <p class="text-sm text-gray-600">Lihat semua feedback</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.laporan.index') }}"
                class="block p-4 bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors">Laporan CSI
                        </h3>
                        <p class="text-sm text-gray-600">Analisis kepuasan</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.kategori.index') }}"
                class="block p-4 bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow group">
                <div class="flex items-center">
                    <div class="p-2 bg-maroon-100 rounded-lg group-hover:bg-maroon-200 transition-colors">
                        <svg class="w-6 h-6 text-maroon-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="font-semibold text-gray-900 group-hover:text-maroon-600 transition-colors">Pengaturan
                        </h3>
                        <p class="text-sm text-gray-600">Kelola kategori</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Recent Feedback -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Umpan Balik Terbaru</h2>
                    <a href="{{ route('admin.umpan-balik.index') }}"
                        class="text-sm text-maroon-600 hover:text-maroon-700 font-medium">
                        Lihat Semua →
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if ($statistik['total_feedback'] > 0)
                    <div class="space-y-4">
                        <!-- Sample recent feedback -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <div class="w-8 h-8 bg-maroon-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-maroon-700">A</span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Anonim</p>
                                    <p class="text-xs text-gray-500">{{ date('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-sm text-gray-600">4.5</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        <p class="text-gray-500 mb-2">Belum ada umpan balik</p>
                        <p class="text-sm text-gray-400">Bagikan link form umpan balik kepada pelanggan untuk mulai
                            menerima feedback</p>
                        <a href="{{ route('feedback.form') }}" target="_blank"
                            class="inline-flex items-center mt-4 px-4 py-2 bg-maroon-600 text-white text-sm font-medium rounded-lg hover:bg-maroon-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Lihat Form Feedback
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
