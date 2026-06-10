<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("UPDATE laporan_kasus SET bukti_pendukung = JSON_ARRAY(bukti_pendukung) WHERE bukti_pendukung IS NOT NULL AND bukti_pendukung != '' AND JSON_VALID(bukti_pendukung) = 0");

        Schema::table('laporan_kasus', function (Blueprint $table) {
            $table->json('bukti_pendukung')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('laporan_kasus', function (Blueprint $table) {
            $table->string('bukti_pendukung', 255)->nullable()->change();
        });
    }
};
