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

        <!-- Filter dan Tab Navigation -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <a href="{{ route('admin.laporan.index', array_merge(request()->query(), ['view_type' => 'overview'])) }}"
                        class="py-4 px-1 border-b-2 font-medium text-sm {{ $viewType === 'overview' ? 'border-maroon-500 text-maroon-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Overview
                    </a>
                    <a href="{{ route('admin.laporan.index', array_merge(request()->query(), ['view_type' => 'per_cabang'])) }}"
                        class="py-4 px-1 border-b-2 font-medium text-sm {{ $viewType === 'per_cabang' ? 'border-maroon-500 text-maroon-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Per Cabang
                    </a>
                    <a href="{{ route('admin.laporan.index', array_merge(request()->query(), ['view_type' => 'perbandingan'])) }}"
                        class="py-4 px-1 border-b-2 font-medium text-sm {{ $viewType === 'perbandingan' ? 'border-maroon-500 text-maroon-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Perbandingan
                    </a>
                    <a href="{{ route('admin.laporan.index', array_merge(request()->query(), ['view_type' => 'tren'])) }}"
                        class="py-4 px-1 border-b-2 font-medium text-sm {{ $viewType === 'tren' ? 'border-maroon-500 text-maroon-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Tren Bulanan
                    </a>
                </nav>
            </div>

            <!-- Filter Form -->
            <div class="p-6">
                <form method="GET" action="{{ route('admin.laporan.index') }}" class="space-y-4">
                    <input type="hidden" name="view_type" value="{{ $viewType }}">

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                Mulai</label>
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ $tanggalMulai }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                        </div>

                        <div>
                            <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                Selesai</label>
                            <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ $tanggalSelesai }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                        </div>

                        @if ($viewType === 'per_cabang')
                            <div>
                                <label for="cabang_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih
                                    Cabang</label>
                                <select id="cabang_id" name="cabang_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                                    <option value="">Semua Cabang</option>
                                    @foreach ($cabangList as $cabang)
                                        <option value="{{ $cabang->id }}"
                                            {{ $cabangId == $cabang->id ? 'selected' : '' }}>
                                            {{ $cabang->nama_cabang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if ($viewType === 'perbandingan')
                            <div>
                                <label for="cabang_ids" class="block text-sm font-medium text-gray-700 mb-2">Pilih Cabang
                                    (Multiple)</label>
                                <select id="cabang_ids" name="cabang_ids[]" multiple
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                                    @foreach ($cabangList as $cabang)
                                        <option value="{{ $cabang->id }}"
                                            {{ in_array($cabang->id, request()->get('cabang_ids', [])) ? 'selected' : '' }}>
                                            {{ $cabang->nama_cabang }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Tahan Ctrl untuk memilih multiple cabang</p>
                            </div>
                        @endif

                        @if ($viewType === 'tren')
                            <div>
                                <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                                <select id="tahun" name="tahun"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                                    @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                                        <option value="{{ $i }}"
                                            {{ request()->get('tahun', date('Y')) == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label for="cabang_id_tren" class="block text-sm font-medium text-gray-700 mb-2">Cabang
                                    (Opsional)</label>
                                <select id="cabang_id_tren" name="cabang_id_tren"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                                    <option value="">Semua Cabang</option>
                                    @foreach ($cabangList as $cabang)
                                        <option value="{{ $cabang->id }}"
                                            {{ request()->get('cabang_id_tren') == $cabang->id ? 'selected' : '' }}>
                                            {{ $cabang->nama_cabang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="flex items-end">
                            <button type="submit"
                                class="w-full px-4 py-2 bg-maroon-700 text-white rounded-lg hover:bg-maroon-800 transition-colors">
                                Filter Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if ($viewType === 'overview' && isset($laporanCsi))
            @include('admin.laporan.partials.overview', ['laporanCsi' => $laporanCsi])
        @endif

        @if ($viewType === 'per_cabang')
            @if (isset($laporanCsi))
                @include('admin.laporan.partials.per-cabang', ['laporanCsi' => $laporanCsi])
            @elseif(isset($laporanCsiPerCabang))
                @include('admin.laporan.partials.semua-cabang', [
                    'laporanCsiPerCabang' => $laporanCsiPerCabang,
                ])
            @endif
        @endif

        @if ($viewType === 'perbandingan' && isset($perbandinganCabang))
            @include('admin.laporan.partials.perbandingan', ['perbandinganCabang' => $perbandinganCabang])
        @endif

        @if ($viewType === 'tren' && isset($trenCsi))
            @include('admin.laporan.partials.tren', [
                'trenCsi' => $trenCsi,
                'tahunTerpilih' => $tahunTerpilih,
            ])
        @endif
    </div>
@endsection
