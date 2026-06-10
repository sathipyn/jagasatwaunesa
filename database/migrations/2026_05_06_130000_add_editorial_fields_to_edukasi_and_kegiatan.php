<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('edukasi', function (Blueprint $table) {
            $table->longText('konten_tambahan')->nullable()->after('konten');
            $table->text('closing_image')->nullable()->after('cover_image');
        });

        Schema::table('kegiatan', function (Blueprint $table) {
            $table->longText('konten_tambahan')->nullable()->after('deskripsi');
            $table->text('closing_image')->nullable()->after('cover_image');
        });
    }

    public function down(): void
    {
        Schema::table('edukasi', function (Blueprint $table) {
            $table->dropColumn(['konten_tambahan', 'closing_image']);
        });

        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropColumn(['konten_tambahan', 'closing_image']);
        });
    }
};
