<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kucing', function (Blueprint $table) {
            $table->boolean('tampil_di_beranda')->default(false)->after('open_adopsi');
            $table->unsignedInteger('urutan_beranda')->default(0)->after('tampil_di_beranda');
        });
    }

    public function down(): void
    {
        Schema::table('kucing', function (Blueprint $table) {
            $table->dropColumn(['tampil_di_beranda', 'urutan_beranda']);
        });
    }
};
