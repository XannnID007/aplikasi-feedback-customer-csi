@if (count($perbandinganCabang) > 0)
    <!-- Ranking Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @foreach ($perbandinganCabang as $index => $cabang)
            <div
                class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 
                {{ $index === 0 ? 'ring-2 ring-yellow-400 bg-gradient-to-br from-yellow-50 to-orange-50' : '' }}">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        @if ($index === 0)
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>
                        @else
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                <span class="text-sm font-bold text-gray-600">#{{ $index + 1 }}</span>
                            </div>
                        @endif

                        <div>
                            <h3 class="font-semibold text-gray-900 text-sm">{{ $cabang['nama_cabang'] }}</h3>
                            <p class="text-xs text-gray-500">{{ $cabang['total_responden'] }} responden</p>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <div class="text-3xl font-bold text-maroon-700 mb-1">{{ $cabang['indeks_kepuasan'] }}%</div>
                    <div class="text-sm font-medium text-maroon-600">{{ $cabang['kategori_csi'] }}</div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Detail Comparison Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">Detail Perbandingan CSI</h2>
            <button type="button" onclick="exportPerbandingan('excel')"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm">
                Export Excel
            </button>
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
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">CSI
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Performance</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($perbandinganCabang as $index => $cabang)
                        <tr class="hover:bg-gray-50 {{ $index === 0 ? 'bg-yellow-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($index === 0)
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <span class="text-sm font-bold text-yellow-700">#1</span>
                                    </div>
                                @else
                                    <span class="text-sm font-medium text-gray-600">#{{ $index + 1 }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $cabang['nama_cabang'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="text-sm text-gray-900">{{ $cabang['total_responden'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span
                                    class="text-lg font-bold text-maroon-700">{{ $cabang['indeks_kepuasan'] }}%</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $cabang['indeks_kepuasan'] >= 81
                                        ? 'bg-green-100 text-green-800'
                                        : ($cabang['indeks_kepuasan'] >= 66
                                            ? 'bg-blue-100 text-blue-800'
                                            : ($cabang['indeks_kepuasan'] >= 51
                                                ? 'bg-yellow-100 text-yellow-800'
                                                : ($cabang['indeks_kepuasan'] >= 35
                                                    ? 'bg-orange-100 text-orange-800'
                                                    : 'bg-red-100 text-red-800'))) }}">
                                    {{ $cabang['kategori_csi'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-maroon-600 h-2 rounded-full"
                                        style="width: {{ $cabang['indeks_kepuasan'] }}%"></div>
                                </div>
                                <span class="text-xs text-gray-500 mt-1">{{ $cabang['indeks_kepuasan'] }}%</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Category Breakdown for Top 3 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Breakdown per Kategori (Top 3 Cabang)</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @foreach (array_slice($perbandinganCabang, 0, 3) as $index => $cabang)
                    <div class="space-y-3">
                        <h3 class="font-semibold text-gray-900 flex items-center">
                            <span
                                class="w-6 h-6 bg-maroon-100 text-maroon-800 rounded-full flex items-center justify-center text-xs font-bold mr-2">
                                {{ $index + 1 }}
                            </span>
                            {{ $cabang['nama_cabang'] }}
                        </h3>
                        @foreach ($cabang['detail_kategori'] as $detail)
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="flex justify-between items-center mb-2">
                                    <span
                                        class="text-sm font-medium text-gray-700">{{ $detail['nama_kategori'] }}</span>
                                    <span class="text-sm font-bold text-gray-900">{{ $detail['mss'] }}/5.0</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-maroon-600 h-1.5 rounded-full"
                                        style="width: {{ ($detail['mss'] / 5) * 100 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@else
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
            </path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Data</h3>
        <p class="text-gray-500">Pilih cabang untuk dibandingkan pada filter di atas.</p>
    </div>
@endif

<script>
    function exportPerbandingan(format) {
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        const tanggalSelesai = document.getElementById('tanggal_selesai').value;
        const cabangIds = Array.from(document.getElementById('cabang_ids').selectedOptions).map(option => option.value);

        if (!tanggalMulai || !tanggalSelesai) {
            alert('Silakan pilih tanggal mulai dan selesai terlebih dahulu!');
            return;
        }

        if (cabangIds.length === 0) {
            alert('Silakan pilih minimal satu cabang untuk perbandingan!');
            return;
        }

        // Buat URL untuk export
        let url = '{{ route('admin.laporan.export-perbandingan') }}?' +
            'format=' + format +
            '&tanggal_mulai=' + tanggalMulai +
            '&tanggal_selesai=' + tanggalSelesai;

        cabangIds.forEach(id => {
            url += '&cabang_ids[]=' + id;
        });

        // Buka di tab baru atau download langsung
        window.open(url, '_blank');
    }
</script>
