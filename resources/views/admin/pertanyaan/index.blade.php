@extends('layouts.admin')

@section('title', 'Kelola Pertanyaan')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Pertanyaan</h1>
                <p class="text-gray-600 mt-1">Atur pertanyaan untuk setiap kategori penilaian</p>
            </div>
            <a href="{{ route('admin.pertanyaan.create') }}"
                class="px-4 py-2 bg-maroon-700 text-white rounded-lg hover:bg-maroon-800 transition-colors">
                Tambah Pertanyaan
            </a>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <form method="GET" action="{{ route('admin.pertanyaan.index') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-48">
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">Filter Kategori</label>
                    <select id="kategori_id" name="kategori_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="px-6 py-2 bg-maroon-700 text-white rounded-lg hover:bg-maroon-800 transition-colors">
                        Filter
                    </button>
                </div>

                @if (request('kategori_id'))
                    <div class="flex items-end">
                        <a href="{{ route('admin.pertanyaan.index') }}"
                            class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                            Reset
                        </a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Questions List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            @if ($pertanyaan->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pertanyaan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Urutan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($pertanyaan as $question)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-maroon-100 text-maroon-800">
                                            {{ $question->kategori->nama_kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-md">{{ $question->teks_pertanyaan }}</div>
                                        @if ($question->wajib_diisi)
                                            <span
                                                class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 mt-1">
                                                Wajib
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $question->tipe_pertanyaan == 'rating'
                                    ? 'bg-blue-100 text-blue-800'
                                    : ($question->tipe_pertanyaan == 'teks'
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($question->tipe_pertanyaan) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $question->urutan }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($question->status_aktif)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.pertanyaan.show', $question) }}"
                                                class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors text-xs"
                                                title="Lihat Detail">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </a>

                                            <a href="{{ route('admin.pertanyaan.edit', $question) }}"
                                                class="inline-flex items-center px-2 py-1 bg-maroon-100 text-maroon-700 rounded-md hover:bg-maroon-200 transition-colors text-xs"
                                                title="Edit">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.pertanyaan.destroy', $question) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus kategori ini? Semua pertanyaan dalam kategori ini juga akan terhapus.')"
                                                    class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors text-xs"
                                                    title="Hapus">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $pertanyaan->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <p class="text-gray-500">Belum ada pertanyaan</p>
                    <a href="{{ route('admin.pertanyaan.create') }}" class="mt-2 text-maroon-600 hover:text-maroon-700">
                        Tambah pertanyaan pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
