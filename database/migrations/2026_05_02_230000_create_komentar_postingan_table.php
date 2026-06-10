<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komentar_postingan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('edukasi_id')->nullable()->constrained('edukasi')->cascadeOnDelete();
            $table->foreignId('kegiatan_id')->nullable()->constrained('kegiatan')->cascadeOnDelete();
            $table->string('isi_komentar', 225);
            $table->date('tanggal_komentar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar_postingan');
    }
};
