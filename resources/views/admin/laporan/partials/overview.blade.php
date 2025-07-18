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

                <!-- Export Buttons -->
                <div class="mt-6 space-y-2">
                    <button type="button" onclick="generateLaporan('pdf')"
                        class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm">
                        Export PDF
                    </button>
                    <button type="button" onclick="generateLaporan('excel')"
                        class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm">
                        Export Excel
                    </button>
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
                            <th class="text-center py-3 px-4 font-semibold text-gray-900">Responden</th>
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
                                    <span class="text-sm font-medium">{{ $detail['mss'] }}</span>
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
                                <td class="py-4 px-4 text-center">
                                    <span class="text-sm">{{ $detail['total_responden'] ?? 0 }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <!-- No Data State -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
            </path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Data</h3>
        <p class="text-gray-500 mb-4">Tidak ada umpan balik pelanggan pada periode yang dipilih.</p>
    </div>
@endif

<script>
    function generateLaporan(format) {
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        const tanggalSelesai = document.getElementById('tanggal_selesai').value;
        const cabangId = document.getElementById('cabang_id')?.value || '';

        if (!tanggalMulai || !tanggalSelesai) {
            alert('Silakan pilih tanggal mulai dan selesai terlebih dahulu!');
            return;
        }

        // Buat URL untuk export
        let url = '{{ route('admin.laporan.export') }}?' +
            'format=' + format +
            '&tanggal_mulai=' + tanggalMulai +
            '&tanggal_selesai=' + tanggalSelesai;

        if (cabangId) {
            url += '&cabang_id=' + cabangId;
        }

        // Buka di tab baru atau download langsung
        window.open(url, '_blank');
    }
</script>
