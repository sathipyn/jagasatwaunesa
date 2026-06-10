<div class="rounded-[2rem] border border-pink-100 bg-white p-6 shadow-xl shadow-pink-100/40 sm:p-8">
    <div class="border-b border-gray-100 pb-6">
        <p class="text-sm font-semibold text-pink-500">Profil akun</p>
        <h2 class="mt-1 text-2xl font-extrabold text-gray-900">Edit data diri kamu</h2>
        <p class="mt-2 text-sm leading-6 text-gray-500">
            Perbarui foto profil, identitas akun, dan password supaya aktivitas komentar, donasi, dan laporanmu tetap rapi.
        </p>
    </div>

    @if($showSuccess)
        <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
            Profil berhasil diperbarui.
        </div>
    @endif

    <form wire:submit="save" class="mt-6 space-y-6">
        <div class="rounded-[1.5rem] border border-gray-100 bg-gray-50/70 p-5">
            <p class="text-sm font-semibold text-gray-900">Foto profil</p>
            <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center">
                <div class="flex h-24 w-24 items-center justify-center overflow-hidden rounded-full border border-pink-100 bg-white shadow-sm">
                    @if($foto_profil)
                        <img src="{{ $foto_profil->temporaryUrl() }}" alt="Preview foto profil" class="h-full w-full object-cover">
                    @elseif($foto_profil_lama)
                        <img src="{{ route('media.public', ['path' => $foto_profil_lama]) }}" alt="Foto profil" class="h-full w-full object-cover">
                    @else
                        <span class="text-3xl font-bold text-pink-300">{{ strtoupper(substr(auth()->user()->nama_lengkap ?? 'U', 0, 1)) }}</span>
                    @endif
                </div>
                <div class="flex-1">
                    <input
                        type="file"
                        wire:model="foto_profil"
                        accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-pink-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-pink-600 hover:file:bg-pink-200"
                    >
                    <p class="mt-2 text-xs text-gray-400">JPG / PNG, maksimal 2MB.</p>
                    @error('foto_profil') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                @if($foto_profil_lama)
                    <button type="button" wire:click="removePhoto" class="inline-flex items-center justify-center rounded-full border border-pink-200 px-4 py-2 text-sm font-semibold text-pink-600 transition hover:bg-pink-50">
                        Hapus foto
                    </button>
                @endif
            </div>
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Nama lengkap</label>
                <input type="text" wire:model="nama_lengkap" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200">
                @error('nama_lengkap') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Username</label>
                <input type="text" wire:model="username" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200">
                @error('username') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model="email" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200">
                @error('email') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="rounded-[1.5rem] border border-gray-100 bg-gray-50/70 p-5">
            <p class="text-sm font-semibold text-gray-900">Ganti password</p>
            <p class="mt-1 text-xs text-gray-500">Kosongkan kalau tidak ingin mengganti password.</p>

            <div class="mt-4 grid gap-5 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Password saat ini</label>
                    <input type="password" wire:model="current_password" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200">
                    @error('current_password') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Password baru</label>
                    <input type="password" wire:model="password" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200">
                    @error('password') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Konfirmasi password baru</label>
                    <input type="password" wire:model="password_confirmation" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200">
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" wire:loading.attr="disabled" class="inline-flex items-center justify-center rounded-full bg-pink-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600 disabled:opacity-60">
                Simpan profil
            </button>
        </div>
    </form>
</div>
