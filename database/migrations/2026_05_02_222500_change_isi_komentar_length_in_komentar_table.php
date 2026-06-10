<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('komentar', function (Blueprint $table) {
            $table->string('isi_komentar', 225)->change();
        });
    }

    public function down(): void
    {
        Schema::table('komentar', function (Blueprint $table) {
            $table->string('isi_komentar', 50)->change();
        });
    }
};
