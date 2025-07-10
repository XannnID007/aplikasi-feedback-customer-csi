@extends('layouts.admin')

@section('title', 'Edit Pertanyaan')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Pertanyaan</h1>
                <p class="text-gray-600 mt-1">Ubah pertanyaan dalam kategori: {{ $pertanyaan->kategori->nama_kategori }}</p>
            </div>
            <a href="{{ route('admin.pertanyaan.index') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <form action="{{ route('admin.pertanyaan.update', $pertanyaan) }}" method="POST" class="space-y-6"
                x-data="questionForm()">
                @csrf
                @method('PUT')

                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select id="kategori_id" name="kategori_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('kategori_id') border-red-500 @enderror">
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}"
                                {{ old('kategori_id', $pertanyaan->kategori_id) == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="teks_pertanyaan" class="block text-sm font-medium text-gray-700 mb-2">
                        Teks Pertanyaan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="teks_pertanyaan" name="teks_pertanyaan" rows="3" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('teks_pertanyaan') border-red-500 @enderror">{{ old('teks_pertanyaan', $pertanyaan->teks_pertanyaan) }}</textarea>
                    @error('teks_pertanyaan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tipe_pertanyaan" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Pertanyaan <span class="text-red-500">*</span>
                    </label>
                    <select id="tipe_pertanyaan" name="tipe_pertanyaan" required x-model="questionType"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('tipe_pertanyaan') border-red-500 @enderror">
                        <option value="rating"
                            {{ old('tipe_pertanyaan', $pertanyaan->tipe_pertanyaan) == 'rating' ? 'selected' : '' }}>Rating
                            (1-5)</option>
                        <option value="teks"
                            {{ old('tipe_pertanyaan', $pertanyaan->tipe_pertanyaan) == 'teks' ? 'selected' : '' }}>Teks
                        </option>
                        <option value="pilihan_ganda"
                            {{ old('tipe_pertanyaan', $pertanyaan->tipe_pertanyaan) == 'pilihan_ganda' ? 'selected' : '' }}>
                            Pilihan Ganda</option>
                    </select>
                    @error('tipe_pertanyaan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div x-show="questionType === 'pilihan_ganda'" class="space-y-3">
                    <label class="block text-sm font-medium text-gray-700">
                        Pilihan Jawaban <span class="text-red-500">*</span>
                    </label>
                    <template x-for="(option, index) in options" :key="index">
                        <div class="flex gap-2">
                            <input type="text" :name="'pilihan_jawaban[' + index + ']'" x-model="option.text"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500"
                                :placeholder="'Pilihan ' + (index + 1)">
                            <button type="button" @click="removeOption(index)" x-show="options.length > 2"
                                class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                Hapus
                            </button>
                        </div>
                    </template>
                    <button type="button" @click="addOption()"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Tambah Pilihan
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                            Urutan <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="urutan" name="urutan" min="1" required
                            value="{{ old('urutan', $pertanyaan->urutan) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 @error('urutan') border-red-500 @enderror">
                        @error('urutan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="wajib_diisi" name="wajib_diisi" value="1"
                                {{ old('wajib_diisi', $pertanyaan->wajib_diisi) ? 'checked' : '' }}
                                class="h-4 w-4 text-maroon-600 focus:ring-maroon-500 border-gray-300 rounded">
                            <label for="wajib_diisi" class="ml-2 block text-sm text-gray-900">
                                Wajib Diisi
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="status_aktif" name="status_aktif" value="1"
                                {{ old('status_aktif', $pertanyaan->status_aktif) ? 'checked' : '' }}
                                class="h-4 w-4 text-maroon-600 focus:ring-maroon-500 border-gray-300 rounded">
                            <label for="status_aktif" class="ml-2 block text-sm text-gray-900">
                                Status Aktif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="px-6 py-2 bg-maroon-700 text-white rounded-lg hover:bg-maroon-800 transition-colors">
                        Update Pertanyaan
                    </button>

                    <a href="{{ route('admin.pertanyaan.index') }}"
                        class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function questionForm() {
            return {
                questionType: '{{ old('tipe_pertanyaan', $pertanyaan->tipe_pertanyaan) }}',
                options: @json(old('pilihan_jawaban', $pertanyaan->pilihan_jawaban ?? []) . map(fn($item) => ['text' => $item])),

                addOption() {
                    this.options.push({
                        text: ''
                    });
                },

                removeOption(index) {
                    if (this.options.length > 2) {
                        this.options.splice(index, 1);
                    }
                }
            }
        }
    </script>
@endsection
