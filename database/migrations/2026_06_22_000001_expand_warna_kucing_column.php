<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE kucing MODIFY warna_kucing VARCHAR(50) NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE kucing MODIFY warna_kucing VARCHAR(10) NULL');
    }
};
