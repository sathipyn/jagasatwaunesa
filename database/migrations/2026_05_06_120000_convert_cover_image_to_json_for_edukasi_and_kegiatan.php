<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE edukasi MODIFY cover_image TEXT NULL');
        DB::statement('ALTER TABLE kegiatan MODIFY cover_image TEXT NULL');

        $this->migrateTable('edukasi');
        $this->migrateTable('kegiatan');
    }

    public function down(): void
    {
        $this->restoreTable('edukasi');
        $this->restoreTable('kegiatan');

        DB::statement('ALTER TABLE edukasi MODIFY cover_image VARCHAR(255) NULL');
        DB::statement('ALTER TABLE kegiatan MODIFY cover_image VARCHAR(255) NULL');
    }

    private function migrateTable(string $table): void
    {
        DB::table($table)
            ->select('id', 'cover_image')
            ->orderBy('id')
            ->get()
            ->each(function ($record) use ($table) {
                if (blank($record->cover_image)) {
                    return;
                }

                $decoded = json_decode($record->cover_image, true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    return;
                }

                DB::table($table)
                    ->where('id', $record->id)
                    ->update([
                        'cover_image' => json_encode([$record->cover_image], JSON_UNESCAPED_SLASHES),
                    ]);
            });
    }

    private function restoreTable(string $table): void
    {
        DB::table($table)
            ->select('id', 'cover_image')
            ->orderBy('id')
            ->get()
            ->each(function ($record) use ($table) {
                if (blank($record->cover_image)) {
                    return;
                }

                $decoded = json_decode($record->cover_image, true);
                $firstImage = is_array($decoded) ? ($decoded[0] ?? null) : $record->cover_image;

                DB::table($table)
                    ->where('id', $record->id)
                    ->update([
                        'cover_image' => $firstImage,
                    ]);
            });
    }
};
