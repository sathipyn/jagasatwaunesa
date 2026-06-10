<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ProfilUserForm extends Component
{
    use WithFileUploads;

    public string $nama_lengkap = '';
    public string $username = '';
    public string $email = '';
    public ?TemporaryUploadedFile $foto_profil = null;
    public ?string $foto_profil_lama = null;
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $showSuccess = false;

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->nama_lengkap = $user->nama_lengkap;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->foto_profil_lama = $user->foto_profil;
    }

    public function save(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $this->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:100', Rule::unique(User::class)->ignore($user->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', Rule::unique(User::class)->ignore($user->id)],
            'foto_profil' => ['nullable', 'image', 'max:10240'],
            'current_password' => ['nullable', 'required_with:password', 'current_password'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required_with' => 'Password saat ini wajib diisi jika ingin mengganti password.',
            'current_password.current_password' => 'Password saat ini tidak cocok.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'foto_profil.image' => 'Foto profil harus berupa gambar.',
            'foto_profil.max' => 'Ukuran foto profil maksimal 2MB.',
        ]);

        $user->nama_lengkap = $validated['nama_lengkap'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];

        if ($this->foto_profil) {
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $user->foto_profil = $this->foto_profil->storeAs(
                'foto-profil',
                Str::uuid() . '.' . $this->foto_profil->getClientOriginalExtension(),
                'public'
            );
            $this->foto_profil_lama = $user->foto_profil;
        }

        if ($validated['password'] ?? false) {
            $user->password = Hash::make($validated['password']);
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->reset('current_password', 'password', 'password_confirmation', 'foto_profil');
        $this->showSuccess = true;
    }

    public function removePhoto(): void
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        $user->update(['foto_profil' => null]);
        $this->foto_profil_lama = null;
        $this->foto_profil = null;
        $this->showSuccess = true;
    }

    public function render()
    {
        return view('livewire.profil-user-form');
    }
}
