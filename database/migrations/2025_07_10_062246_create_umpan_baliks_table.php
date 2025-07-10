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
        Schema::create('umpan_balik', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan')->nullable();
            $table->string('email_pelanggan')->nullable();
            $table->string('telepon_pelanggan')->nullable();
            $table->date('tanggal_kunjungan');
            $table->text('komentar_umum')->nullable();
            $table->decimal('rating_keseluruhan', 3, 2)->nullable();
            $table->timestamps();

            $table->index(['tanggal_kunjungan', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umpan_balik');
    }
};
