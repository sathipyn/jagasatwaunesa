<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donasi', function (Blueprint $table) {
            $table->text('hasil_penggunaan')->nullable()->after('bukti_transfer');
            $table->date('tanggal_penggunaan')->nullable()->after('hasil_penggunaan');
            $table->json('foto_penggunaan')->nullable()->after('tanggal_penggunaan');
        });
    }

    public function down(): void
    {
        Schema::table('donasi', function (Blueprint $table) {
            $table->dropColumn(['hasil_penggunaan', 'tanggal_penggunaan', 'foto_penggunaan']);
        });
    }
};
