<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('jabatan', 50)->nullable();
            $table->string('divisi', 50)->nullable();
            $table->string('jurusan', 50)->nullable();
            $table->string('angkatan', 50)->nullable();
            $table->string('status_keanggotaan', 30)->default('aktif'); // aktif, tidak aktif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};