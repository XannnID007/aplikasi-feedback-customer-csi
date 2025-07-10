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
        Schema::create('laporan_csi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_laporan');
            $table->date('periode_mulai');
            $table->date('periode_selesai');
            $table->integer('total_responden');
            $table->decimal('indeks_kepuasan', 5, 2); // CSI value
            $table->json('detail_kategori'); // CSI per kategori
            $table->json('statistik_tambahan')->nullable();
            $table->timestamps();

            $table->index(['tanggal_laporan', 'periode_mulai', 'periode_selesai']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_csi');
    }
};
