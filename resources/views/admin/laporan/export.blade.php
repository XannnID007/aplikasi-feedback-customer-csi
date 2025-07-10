@extends('layouts.admin')

@section('title', 'Export Laporan CSI')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Export Laporan CSI</h1>
                <p class="text-gray-600 mt-1">Download laporan Customer Satisfaction Index dalam berbagai format</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                Kembali
            </a>
        </div>

        <!-- Export Options -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- PDF Export -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-red-100 rounded-full mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Export PDF</h3>
                        <p class="text-sm text-gray-600">Laporan lengkap dalam format PDF</p>
                    </div>
                </div>

                <form action="{{ route('admin.laporan.export') }}" method="GET" class="space-y-4">
                    <input type="hidden" name="format" value="pdf">

                    <div>
                        <label for="pdf_tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                            Mulai</label>
                        <input type="date" id="pdf_tanggal_mulai" name="tanggal_mulai" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500"
                            value="{{ date('Y-m-01') }}">
                    </div>

                    <div>
                        <label for="pdf_tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                            Selesai</label>
                        <input type="date" id="pdf_tanggal_selesai" name="tanggal_selesai" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500"
                            value="{{ date('Y-m-t') }}">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="include_charts" name="include_charts" value="1" checked
                            class="h-4 w-4 text-maroon-600 focus:ring-maroon-500 border-gray-300 rounded">
                        <label for="include_charts" class="ml-2 block text-sm text-gray-900">
                            Sertakan grafik dan visualisasi
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Download PDF
                    </button>
                </form>
            </div>

            <!-- Excel Export -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="p-3 bg-green-100 rounded-full mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Export Excel</h3>
                        <p class="text-sm text-gray-600">Data mentah untuk analisis lebih lanjut</p>
                    </div>
                </div>

                <form action="{{ route('admin.laporan.export') }}" method="GET" class="space-y-4">
                    <input type="hidden" name="format" value="excel">

                    <div>
                        <label for="excel_tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                            Mulai</label>
                        <input type="date" id="excel_tanggal_mulai" name="tanggal_mulai" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500"
                            value="{{ date('Y-m-01') }}">
                    </div>

                    <div>
                        <label for="excel_tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                            Selesai</label>
                        <input type="date" id="excel_tanggal_selesai" name="tanggal_selesai" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500"
                            value="{{ date('Y-m-t') }}">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Sheet yang disertakan:</label>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="sheet_summary" name="sheets[]" value="summary" checked
                                    class="h-4 w-4 text-maroon-600 focus:ring-maroon-500 border-gray-300 rounded">
                                <label for="sheet_summary" class="ml-2 block text-sm text-gray-900">
                                    Ringkasan CSI
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="sheet_detail" name="sheets[]" value="detail" checked
                                    class="h-4 w-4 text-maroon-600 focus:ring-maroon-500 border-gray-300 rounded">
                                <label for="sheet_detail" class="ml-2 block text-sm text-gray-900">
                                    Detail per Kategori
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="sheet_raw" name="sheets[]" value="raw_data"
                                    class="h-4 w-4 text-maroon-600 focus:ring-maroon-500 border-gray-300 rounded">
                                <label for="sheet_raw" class="ml-2 block text-sm text-gray-900">
                                    Data Mentah Feedback
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Download Excel
                    </button>
                </form>
            </div>
        </div>

        <!-- Export History -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Riwayat Export</h2>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <!-- Sample export history - replace with actual data -->
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Laporan CSI - Januari 2025.pdf</p>
                                <p class="text-xs text-gray-500">{{ date('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">2.1 MB</div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Data Feedback - Desember 2024.xlsx</p>
                                <p class="text-xs text-gray-500">{{ date('d M Y', strtotime('-7 days')) }}, 14:30</p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">856 KB</div>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-500">File export akan tersimpan selama 30 hari</p>
                </div>
            </div>
        </div>

        <!-- Export Tips -->
        <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
            <h3 class="text-lg font-semibold text-blue-900 mb-3">Tips Export</h3>
            <ul class="space-y-2 text-sm text-blue-800">
                <li class="flex items-start">
                    <svg class="w-4 h-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span><strong>PDF:</strong> Ideal untuk presentasi dan laporan formal dengan visualisasi lengkap</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-4 h-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span><strong>Excel:</strong> Cocok untuk analisis data lebih lanjut dan manipulasi angka</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-4 h-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Pilih periode yang tidak terlalu panjang untuk performa export yang optimal</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-4 h-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Data mentah feedback berguna untuk penelitian dan analisis mendalam</span>
                </li>
            </ul>
        </div>
    </div>
@endsection
