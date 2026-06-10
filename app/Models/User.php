<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'username',
        'foto_profil',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ✅ WAJIB — Filament v4 pakai ini untuk ambil nama user
    public function getFilamentName(): string
    {
        return $this->nama_lengkap ?? $this->email ?? 'Admin';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(['super_admin', 'admin_rescue', 'admin_donasi']);
    }

    // ==================== RELASI ====================

    public function laporanKasus()
    {
        return $this->hasMany(LaporanKasus::class);
    }

    public function donasi()
    {
        return $this->hasMany(Donasi::class);
    }

    public function adopsi()
    {
        return $this->hasMany(Adopsi::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    public function komentarPostingan()
    {
        return $this->hasMany(KomentarPostingan::class);
    }
}
