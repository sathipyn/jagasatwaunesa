<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adopsi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kucing_id')->constrained('kucing')->onDelete('cascade');
            $table->date('tanggal_pengajuan');
            $table->string('status_adopsi', 30)->default('Pending'); // Pending, Diterima, Ditolak
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adopsi');
    }
};