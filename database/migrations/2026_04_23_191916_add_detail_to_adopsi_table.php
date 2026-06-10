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
        Schema::table('adopsi', function (Blueprint $table) {

            $table->string('nama_lengkap')->nullable();
            $table->enum('status', ['Bekerja', 'Kuliah', 'Lainnya'])->nullable();
            $table->text('alasan')->nullable();

            $table->string('no_hp')->nullable();
            $table->string('domisili')->nullable();

            $table->enum('pro_dokter_hewan', ['Ya', 'Tidak', 'Mungkin'])->nullable();

            $table->enum('update_kabar', ['Ya', 'Tidak'])->nullable();

            $table->bigInteger('penghasilan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adopsi', function (Blueprint $table) {
            //
        });
    }
};
