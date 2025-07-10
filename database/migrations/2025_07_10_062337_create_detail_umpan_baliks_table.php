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
        Schema::create('detail_umpan_balik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umpan_balik_id')->constrained('umpan_balik')->cascadeOnDelete();
            $table->foreignId('pertanyaan_id')->constrained('pertanyaan')->cascadeOnDelete();
            $table->text('jawaban_teks')->nullable();
            $table->integer('nilai_rating')->nullable();
            $table->timestamps();

            $table->index(['umpan_balik_id', 'pertanyaan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_umpan_balik');
    }
};
