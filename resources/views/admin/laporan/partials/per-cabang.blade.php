@if ($laporanCsi['total_responden'] > 0)
    <!-- Cabang Info Header -->
    @if ($laporanCsi['cabang_info'])
        <div class="bg-gradient-to-r from-maroon-700 to-maroon-600 rounded-xl p-6 text-white mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">{{ $laporanCsi['cabang_info']->nama_cabang }}</h2>
                    <p class="text-maroon-100 mt-1">{{ $laporanCsi['cabang_info']->alamat }}</p>
                    @if ($laporanCsi['cabang_info']->telepon)
                        <p class="text-maroon-200 text-sm mt-1">📞 {{ $laporanCsi['cabang_info']->telepon }}</p>
                    @endif
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold">{{ $laporanCsi['indeks_kepuasan'] }}%</div>
                    <div class="text-maroon-100">{{ $laporanCsi['kategori_csi'] }}</div>
                </div>
            </div>
        </div>
    @endif

    <!-- CSI Overview untuk Cabang Spesifik -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- CSI Score -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 text-center">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                CSI Score
                @if ($laporanCsi['cabang_info'])
                    <br><span
                        class="text-sm font-normal text-gray-600">{{ $laporanCsi['cabang_info']->nama_cabang }}</span>
                @endif
            </h3>
            <div class="mb-4">
                <div class="text-5xl font-bold text-maroon-700 mb-2">{{ $laporanCsi['indeks_kepuasan'] }}%</div>
                <div class="text-xl font-medium text-maroon-600">{{ $laporanCsi['kategori_csi'] }}</div>
            </div>
            <div class="text-sm text-gray-500">
                {{ $laporanCsi['total_responden'] }} responden
            </div>
            <div class="mt-4 text-xs text-gray-400">
                {{ date('d M Y', strtotime($tanggalMulai)) }} - {{ date('d M Y', strtotime($tanggalSelesai)) }}
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

        <!-- Performance Radar -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Performance per Kategori</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($laporanCsi['detail_kategori'] as $detail)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900">{{ $detail['nama_kategori'] }}</div>
                            <div class="text-xs text-gray-500">{{ $detail['total_responden'] ?? 0 }} responden</div>
                        </div>
                        <div class="text-right ml-4">
                            <div class="text-lg font-bold text-maroon-700">{{ $detail['mss'] }}/5.0</div>
                            <div class="w-16 bg-gray-200 rounded-full h-2">
                                <div class="bg-maroon-600 h-2 rounded-full"
                                    style="width: {{ ($detail['mss'] / 5) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Detailed Analysis Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Analisis Detail CSI</h2>
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
                                    <span class="text-sm font-medium text-maroon-700">{{ $detail['mss'] }}</span>
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
                                        <div class="w-20 bg-gray-200 rounded-full h-2 mr-2">
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

    <!-- Rekomendasi Improvement -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Rekomendasi Perbaikan</h2>
        </div>
        <div class="p-6">
            @php
                $sortedKategori = collect($laporanCsi['detail_kategori'])->sortBy('mss');
                $lowest = $sortedKategori->take(2);
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">📈 Area yang Perlu Diperbaiki</h3>
                    @foreach ($lowest as $kategori)
                        <div class="p-3 bg-red-50 border border-red-200 rounded-lg mb-3">
                            <div class="font-medium text-red-900">{{ $kategori['nama_kategori'] }}</div>
                            <div class="text-sm text-red-700">Score: {{ $kategori['mss'] }}/5.0</div>
                            <div class="text-xs text-red-600 mt-1">
                                Fokus pada peningkatan kualitas {{ strtolower($kategori['nama_kategori']) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">🏆 Kekuatan</h3>
                    @php
                        $highest = $sortedKategori->sortByDesc('mss')->take(2);
                    @endphp
                    @foreach ($highest as $kategori)
                        <div class="p-3 bg-green-50 border border-green-200 rounded-lg mb-3">
                            <div class="font-medium text-green-900">{{ $kategori['nama_kategori'] }}</div>
                            <div class="text-sm text-green-700">Score: {{ $kategori['mss'] }}/5.0</div>
                            <div class="text-xs text-green-600 mt-1">
                                Pertahankan standar {{ strtolower($kategori['nama_kategori']) }} yang baik
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@else
    <!-- No Data State -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
            </path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Data</h3>
        <p class="text-gray-500 mb-4">
            @if ($laporanCsi['cabang_info'])
                Tidak ada umpan balik untuk cabang {{ $laporanCsi['cabang_info']->nama_cabang }} pada periode yang
                dipilih.
            @else
                Tidak ada umpan balik pada periode yang dipilih.
            @endif
        </p>
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
