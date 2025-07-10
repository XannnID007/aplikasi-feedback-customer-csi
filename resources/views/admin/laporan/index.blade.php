@extends('layouts.admin')

@section('title', 'Laporan CSI')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Laporan Customer Satisfaction Index (CSI)</h1>
                <p class="text-gray-600 mt-1">Analisis tingkat kepuasan pelanggan berdasarkan feedback yang diterima</p>
            </div>
        </div>

        <!-- Filter Periode -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-48">
                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ $tanggalMulai }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                </div>

                <div class="flex-1 min-w-48">
                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                        Selesai</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ $tanggalSelesai }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                </div>

                <div>
                    <button type="submit"
                        class="px-6 py-2 bg-maroon-700 text-white rounded-lg hover:bg-maroon-800 transition-colors">
                        Generate Laporan
                    </button>
                </div>
            </form>
        </div>

        @if ($laporanCsi['total_responden'] > 0)
            <!-- CSI Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- CSI Score -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 text-center">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Customer Satisfaction Index</h3>
                        <div class="mb-4">
                            <div class="text-5xl font-bold text-maroon-700 mb-2">{{ $laporanCsi['indeks_kepuasan'] }}%</div>
                            <div class="text-xl font-medium text-maroon-600">{{ $laporanCsi['kategori_csi'] }}</div>
                        </div>
                        <div class="text-sm text-gray-500">
                            Berdasarkan {{ $laporanCsi['total_responden'] }} responden
                        </div>
                        <div class="mt-4 text-xs text-gray-400">
                            Periode: {{ date('d M Y', strtotime($tanggalMulai)) }} -
                            {{ date('d M Y', strtotime($tanggalSelesai)) }}
                        </div>
                    </div>
                </div>

                <!-- CSI Interpretation -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Interpretasi CSI</h3>
                        <div class="space-y-3">
                            <div
                                class="flex items-center justify-between p-3 rounded-lg {{ $laporanCsi['indeks_kepuasan'] >= 81 ? 'bg-green-50 border border-green-200' : 'bg-gray-50' }}">
                                <span class="font-medium">Sangat Puas</span>
                                <span class="text-sm text-gray-600">81% - 100%</span>
                            </div>
                            <div
                                class="flex items-center justify-between p-3 rounded-lg {{ $laporanCsi['indeks_kepuasan'] >= 66 && $laporanCsi['indeks_kepuasan'] < 81 ? 'bg-blue-50 border border-blue-200' : 'bg-gray-50' }}">
                                <span class="font-medium">Puas</span>
                                <span class="text-sm text-gray-600">66% - 80%</span>
                            </div>
                            <div
                                class="flex items-center justify-between p-3 rounded-lg {{ $laporanCsi['indeks_kepuasan'] >= 51 && $laporanCsi['indeks_kepuasan'] < 66 ? 'bg-yellow-50 border border-yellow-200' : 'bg-gray-50' }}">
                                <span class="font-medium">Cukup Puas</span>
                                <span class="text-sm text-gray-600">51% - 65%</span>
                            </div>
                            <div
                                class="flex items-center justify-between p-3 rounded-lg {{ $laporanCsi['indeks_kepuasan'] >= 35 && $laporanCsi['indeks_kepuasan'] < 51 ? 'bg-orange-50 border border-orange-200' : 'bg-gray-50' }}">
                                <span class="font-medium">Kurang Puas</span>
                                <span class="text-sm text-gray-600">35% - 50%</span>
                            </div>
                            <div
                                class="flex items-center justify-between p-3 rounded-lg {{ $laporanCsi['indeks_kepuasan'] < 35 ? 'bg-red-50 border border-red-200' : 'bg-gray-50' }}">
                                <span class="font-medium">Tidak Puas</span>
                                <span class="text-sm text-gray-600">0% - 34%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Analysis -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Analisis Detail per Kategori</h2>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 font-semibold text-gray-900">Kategori</th>
                                    <th class="text-center py-3 px-4 font-semibold text-gray-900">MIS</th>
                                    <th class="text-center py-3 px-4 font-semibold text-gray-900">MSS</th>
                                    <th class="text-center py-3 px-4 font-semibold text-gray-900">WF</th>
                                    <th class="text-center py-3 px-4 font-semibold text-gray-900">WS</th>
                                    <th class="text-center py-3 px-4 font-semibold text-gray-900">Performance</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($laporanCsi['detail_kategori'] as $detail)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4 px-4">
                                            <div class="font-medium text-gray-900">{{ $detail['nama_kategori'] }}</div>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="text-sm font-medium">{{ $detail['mis'] }}</span>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <div class="flex items-center justify-center">
                                                <span class="text-sm font-medium mr-2">{{ $detail['mss'] }}</span>
                                                <div class="flex items-center">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-3 h-3 {{ $i <= $detail['mss'] ? 'text-yellow-400' : 'text-gray-300' }}"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                            </path>
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="text-sm">{{ $detail['wf'] }}</span>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="text-sm font-medium">{{ $detail['ws'] }}</span>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            @php
                                                $performance = ($detail['mss'] / 5) * 100;
                                            @endphp
                                            <div class="flex items-center justify-center">
                                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                    <div class="bg-maroon-600 h-2 rounded-full"
                                                        style="width: {{ $performance }}%"></div>
                                                </div>
                                                <span
                                                    class="text-xs text-gray-600">{{ number_format($performance, 1) }}%</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Methodology -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Metodologi Perhitungan CSI</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-medium text-gray-900 mb-3">Formula Perhitungan:</h3>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><strong>MIS:</strong> Mean Importance Score (Bobot Kategori)</p>
                            <p><strong>MSS:</strong> Mean Satisfaction Score (Rata-rata Rating)</p>
                            <p><strong>WF:</strong> Weight Factor = MIS / Total MIS</p>
                            <p><strong>WS:</strong> Weight Score = WF × MSS</p>
                            <p><strong>CSI:</strong> (Total WS / 5) × 100%</p>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900 mb-3">Interpretasi Hasil:</h3>
                        <div class="space-y-1 text-sm text-gray-600">
                            <p>• CSI ≥ 81%: Pelanggan sangat puas dengan layanan</p>
                            <p>• CSI 66-80%: Pelanggan puas dengan layanan</p>
                            <p>• CSI 51-65%: Pelanggan cukup puas</p>
                            <p>• CSI 35-50%: Pelanggan kurang puas</p>
                            <p>• CSI < 35%: Pelanggan tidak puas</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- No Data State -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Data</h3>
                <p class="text-gray-500 mb-4">Tidak ada umpan balik pelanggan pada periode yang dipilih.</p>
                <p class="text-sm text-gray-400">Silakan pilih periode yang berbeda atau pastikan sudah ada feedback yang
                    masuk.</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Add chart visualization if needed
        @if ($laporanCsi['total_responden'] > 0)
            document.addEventListener('DOMContentLoaded', function() {
                // You can add Chart.js visualization here
            });
        @endif
    </script>
@endsection
