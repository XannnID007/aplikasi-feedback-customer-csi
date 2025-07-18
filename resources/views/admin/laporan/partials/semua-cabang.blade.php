<!-- Laporan Semua Cabang -->
@if (count($laporanCsiPerCabang) > 0)
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        @php
            $totalResponden = collect($laporanCsiPerCabang)->sum('csi_data.total_responden');
            $avgCsi = collect($laporanCsiPerCabang)->avg('csi_data.indeks_kepuasan');
            $bestCabang = collect($laporanCsiPerCabang)->sortByDesc('csi_data.indeks_kepuasan')->first();
            $worstCabang = collect($laporanCsiPerCabang)->sortBy('csi_data.indeks_kepuasan')->first();
        @endphp

        <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Cabang Aktif</p>
                    <p class="text-2xl font-bold text-gray-900">{{ count($laporanCsiPerCabang) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Total Responden</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalResponden) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-maroon-100 rounded-lg">
                    <svg class="w-6 h-6 text-maroon-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                        </path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Rata-rata CSI</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($avgCsi, 1) }}%</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">Range CSI</p>
                    <p class="text-lg font-bold text-gray-900">
                        {{ number_format($worstCabang['csi_data']['indeks_kepuasan'], 1) }}% -
                        {{ number_format($bestCabang['csi_data']['indeks_kepuasan'], 1) }}%
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Best & Worst Performers -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Best Performer -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-green-100 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-green-900">Cabang Terbaik</h3>
            </div>
            <div class="space-y-2">
                <p class="text-2xl font-bold text-green-900">{{ $bestCabang['cabang']->nama_cabang }}</p>
                <p class="text-lg font-semibold text-green-700">
                    CSI: {{ $bestCabang['csi_data']['indeks_kepuasan'] }}%
                    ({{ $bestCabang['csi_data']['kategori_csi'] }})
                </p>
                <p class="text-sm text-green-600">
                    {{ $bestCabang['csi_data']['total_responden'] }} responden
                </p>
            </div>
        </div>

        <!-- Worst Performer -->
        <div class="bg-gradient-to-br from-red-50 to-pink-50 rounded-xl p-6 border border-red-200">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-red-100 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-red-900">Perlu Perhatian</h3>
            </div>
            <div class="space-y-2">
                <p class="text-2xl font-bold text-red-900">{{ $worstCabang['cabang']->nama_cabang }}</p>
                <p class="text-lg font-semibold text-red-700">
                    CSI: {{ $worstCabang['csi_data']['indeks_kepuasan'] }}%
                    ({{ $worstCabang['csi_data']['kategori_csi'] }})
                </p>
                <p class="text-sm text-red-600">
                    {{ $worstCabang['csi_data']['total_responden'] }} responden
                </p>
            </div>
        </div>
    </div>

    <!-- All Branches Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">Laporan CSI Semua Cabang</h2>
            <div class="flex space-x-2">
                <button type="button" onclick="exportAllBranches('pdf')"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm">
                    Export PDF
                </button>
                <button type="button" onclick="exportAllBranches('excel')"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm">
                    Export Excel
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ranking</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Cabang</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Responden</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            CSI</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Performance</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach (collect($laporanCsiPerCabang)->sortByDesc('csi_data.indeks_kepuasan')->values() as $index => $data)
                        <tr class="hover:bg-gray-50 {{ $index < 3 ? 'bg-yellow-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($index === 0)
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-yellow-500 mr-1" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <span class="text-sm font-bold text-yellow-700">#{{ $index + 1 }}</span>
                                    </div>
                                @else
                                    <span class="text-sm font-medium text-gray-600">#{{ $index + 1 }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $data['cabang']->nama_cabang }}
                                </div>
                                <div class="text-xs text-gray-500">{{ Str::limit($data['cabang']->alamat, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="text-sm text-gray-900">{{ $data['csi_data']['total_responden'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="text-lg font-bold text-maroon-700">
                                    {{ $data['csi_data']['indeks_kepuasan'] }}%
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $data['csi_data']['indeks_kepuasan'] >= 81
                                        ? 'bg-green-100 text-green-800'
                                        : ($data['csi_data']['indeks_kepuasan'] >= 66
                                            ? 'bg-blue-100 text-blue-800'
                                            : ($data['csi_data']['indeks_kepuasan'] >= 51
                                                ? 'bg-yellow-100 text-yellow-800'
                                                : ($data['csi_data']['indeks_kepuasan'] >= 35
                                                    ? 'bg-orange-100 text-orange-800'
                                                    : 'bg-red-100 text-red-800'))) }}">
                                    {{ $data['csi_data']['kategori_csi'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-maroon-600 h-2 rounded-full"
                                        style="width: {{ $data['csi_data']['indeks_kepuasan'] }}%"></div>
                                </div>
                                <span
                                    class="text-xs text-gray-500 mt-1">{{ $data['csi_data']['indeks_kepuasan'] }}%</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('admin.laporan.index', ['view_type' => 'per_cabang', 'cabang_id' => $data['cabang']->id, 'tanggal_mulai' => $tanggalMulai, 'tanggal_selesai' => $tanggalSelesai]) }}"
                                    class="text-maroon-600 hover:text-maroon-900 text-sm font-medium">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
            </path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Data</h3>
        <p class="text-gray-500">Tidak ada cabang dengan feedback pada periode yang dipilih.</p>
    </div>
@endif

<script>
    function exportAllBranches(format) {
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        const tanggalSelesai = document.getElementById('tanggal_selesai').value;

        if (!tanggalMulai || !tanggalSelesai) {
            alert('Silakan pilih tanggal mulai dan selesai terlebih dahulu!');
            return;
        }

        // Buat URL untuk export semua cabang
        let url = '{{ route('admin.laporan.export') }}?' +
            'format=' + format +
            '&tanggal_mulai=' + tanggalMulai +
            '&tanggal_selesai=' + tanggalSelesai +
            '&view_type=semua_cabang';

        // Buka di tab baru atau download langsung
        window.open(url, '_blank');
    }
</script>
