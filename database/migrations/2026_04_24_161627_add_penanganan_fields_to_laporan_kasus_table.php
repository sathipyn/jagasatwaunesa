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
        Schema::table('laporan_kasus', function (Blueprint $table) {
            $table->text('hasil_penanganan')->nullable();
            $table->json('foto_penanganan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_kasus', function (Blueprint $table) {
            //
        });
    }
};
