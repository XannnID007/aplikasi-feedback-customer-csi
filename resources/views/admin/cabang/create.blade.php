@extends('layouts.admin')

@section('title', 'Tambah Cabang')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Cabang Baru</h1>
                <p class="text-gray-600 mt-1">Buat cabang baru untuk Dimsum BOS</p>
            </div>
            <a href="{{ route('admin.cabang.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <form action="{{ route('admin.cabang.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_cabang" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Cabang <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_cabang" name="nama_cabang" required value="{{ old('nama_cabang') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('nama_cabang') border-red-500 @enderror"
                            placeholder="Contoh: Dimsum BOS Jakarta Pusat">
                        @error('nama_cabang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                            Urutan <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="urutan" name="urutan" min="1" required
                            value="{{ old('urutan', 1) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('urutan') border-red-500 @enderror">
                        @error('urutan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alamat" name="alamat" rows="3" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('alamat') border-red-500 @enderror"
                        placeholder="Alamat lengkap cabang">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                            Telepon
                        </label>
                        <input type="tel" id="telepon" name="telepon" value="{{ old('telepon') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('telepon') border-red-500 @enderror"
                            placeholder="(021) 123-4567">
                        @error('telepon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('email') border-red-500 @enderror"
                            placeholder="cabang@dimsumbos.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="jam_operasional" class="block text-sm font-medium text-gray-700 mb-2">
                        Jam Operasional
                    </label>
                    <input type="text" id="jam_operasional" name="jam_operasional" value="{{ old('jam_operasional') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('jam_operasional') border-red-500 @enderror"
                        placeholder="Senin-Jumat: 10:00-22:00, Sabtu-Minggu: 09:00-23:00">
                    @error('jam_operasional')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('deskripsi') border-red-500 @enderror"
                        placeholder="Deskripsi singkat tentang cabang ini">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="status_aktif" name="status_aktif" value="1" checked
                        class="h-4 w-4 text-maroon-600 focus:ring-maroon-500 border-gray-300 rounded">
                    <label for="status_aktif" class="ml-2 block text-sm text-gray-900">
                        Status Aktif
                    </label>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 bg-maroon-700 text-white rounded-lg hover:bg-maroon-800 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Cabang
                    </button>

                    <a href="{{ route('admin.cabang.index') }}"
                        class="inline-flex items-center px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
