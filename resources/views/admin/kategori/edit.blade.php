@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Kategori Penilaian</h1>
                <p class="text-gray-600 mt-1">Ubah data kategori: {{ $kategori->nama_kategori }}</p>
            </div>
            <a href="{{ route('admin.kategori.index') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_kategori" name="nama_kategori" required
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('nama_kategori') border-red-500 @enderror">
                    @error('nama_kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                        Keterangan
                    </label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('keterangan') border-red-500 @enderror">{{ old('keterangan', $kategori->keterangan) }}</textarea>
                    @error('keterangan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bobot" class="block text-sm font-medium text-gray-700 mb-2">
                        Bobot <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="bobot" name="bobot" min="1" max="10" required
                        value="{{ old('bobot', $kategori->bobot) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('bobot') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Bobot kategori untuk perhitungan CSI (1-10)</p>
                    @error('bobot')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="status_aktif" name="status_aktif" value="1"
                        {{ old('status_aktif', $kategori->status_aktif) ? 'checked' : '' }}
                        class="h-4 w-4 text-maroon-600 focus:ring-maroon-500 border-gray-300 rounded">
                    <label for="status_aktif" class="ml-2 block text-sm text-gray-900">
                        Status Aktif
                    </label>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="px-6 py-2 bg-maroon-700 text-white rounded-lg hover:bg-maroon-800 transition-colors">
                        Update Kategori
                    </button>

                    <a href="{{ route('admin.kategori.index') }}"
                        class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
