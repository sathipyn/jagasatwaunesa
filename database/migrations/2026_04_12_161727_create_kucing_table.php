<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kucing', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kucing', 100);
            $table->text('riwayat_sakit')->nullable();
            $table->string('jenis_kelamin', 50)->nullable();
            $table->string('warna_kucing', 10)->nullable();  // warna bulu
            $table->string('steril_kucing', 50)->nullable();  // sudah/belum
            $table->string('vaksin_kucing', 50)->nullable();
            $table->text('lokasi_kucing')->nullable();
            $table->string('foto', 255)->nullable();
            $table->boolean('open_adopsi')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kucing');
    }
};