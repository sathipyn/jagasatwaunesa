<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_kasus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul_laporan', 255);
            $table->text('deskripsi_kasus');
            $table->date('tanggal_laporan');
            $table->string('lokasi_laporan', 255)->nullable();
            $table->string('status_laporan', 30)->default('Diproses'); // Diproses, Selesai
            $table->string('bukti_pendukung', 255)->nullable(); // foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_kasus');
    }
};