<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_penilaian')->cascadeOnDelete();
            $table->text('teks_pertanyaan');
            $table->enum('tipe_pertanyaan', ['rating', 'teks', 'pilihan_ganda']);
            $table->json('pilihan_jawaban')->nullable(); // untuk pilihan ganda
            $table->integer('urutan')->default(1);
            $table->boolean('wajib_diisi')->default(true);
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan');
    }
};
