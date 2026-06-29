<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penggunaan_dana', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kategori', 30);
            $table->double('jumlah');
            $table->text('keterangan')->nullable();
            $table->json('foto_bukti')->nullable();
            $table->boolean('tampil_di_publik')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggunaan_dana');
    }
};
