<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan_kasus', function (Blueprint $table) {
            $table->string('kategori_kasus', 50)->default('kasus_lainnya');
        });
    }

    public function down(): void
    {
        Schema::table('laporan_kasus', function (Blueprint $table) {
            $table->dropColumn('kategori_kasus');
        });
    }
};
