<div class="rounded-[1.75rem] border border-gray-100 bg-white p-6 shadow-sm sm:p-7">
    <div class="flex flex-col gap-2 border-b border-gray-100 pb-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-pink-500">Komentar pengunjung</p>
            <h2 class="mt-1 text-2xl font-extrabold text-gray-900">Cerita tentang {{ $kucing->nama_kucing ?: 'kucing ini' }}</h2>
        </div>
        <span class="inline-flex w-fit rounded-full bg-pink-50 px-3 py-1.5 text-xs font-semibold text-pink-600">
            {{ $komentar->count() }} komentar
        </span>
    </div>

    @auth
        @if($showSuccess)
            <div class="mt-5 rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                Komentar berhasil dikirim.
            </div>
        @endif

        <form wire:submit="submit" class="mt-5">
            <label for="isi_komentar" class="mb-2 block text-sm font-semibold text-gray-700">Tulis komentar</label>
            <textarea
                id="isi_komentar"
                wire:model="isi_komentar"
                rows="3"
                maxlength="225"
                class="w-full resize-none rounded-2xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200"
                placeholder="Contoh: Sering terlihat di depan perpustakaan."
            ></textarea>
            <div class="mt-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    @error('isi_komentar')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @else
                        <p class="text-xs text-gray-400">Maksimal 225 karakter.</p>
                    @enderror
                </div>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center rounded-full bg-pink-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-pink-600 disabled:cursor-not-allowed disabled:opacity-70"
                >
                    <span wire:loading.remove>Kirim komentar</span>
                    <span wire:loading>Mengirim...</span>
                </button>
            </div>
        </form>
    @else
        <div class="mt-5 rounded-2xl border border-pink-100 bg-pink-50/70 p-5">
            <p class="text-sm font-semibold text-gray-900">Masuk untuk ikut berkomentar.</p>
            <p class="mt-1 text-sm leading-6 text-gray-500">Komentar membantu tim dan pengunjung lain mengenali kebiasaan kucing kampus.</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <a href="{{ route('login', ['redirect_to' => request()->getRequestUri()]) }}" class="inline-flex items-center justify-center rounded-full bg-pink-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-pink-600">
                    Login
                </a>
                <a href="{{ route('register', ['redirect_to' => request()->getRequestUri()]) }}" class="inline-flex items-center justify-center rounded-full border border-pink-200 bg-white px-5 py-2.5 text-sm font-semibold text-pink-600 transition hover:bg-pink-50">
                    Daftar akun
                </a>
            </div>
        </div>
    @endauth

    <div class="mt-7 space-y-4">
        @forelse($komentar as $item)
            <article class="rounded-2xl border border-gray-100 bg-gray-50/70 p-4">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $item->user->nama_lengkap ?? $item->user->username ?? 'User JagaSatwa' }}</p>
                        <p class="mt-1 text-xs text-gray-400">{{ $item->tanggal_komentar?->format('d M Y') }}</p>
                    </div>
                </div>
                <p class="mt-3 text-sm leading-6 text-gray-600">{{ $item->isi_komentar }}</p>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-5 text-center">
                <p class="text-sm font-semibold text-gray-700">Belum ada komentar.</p>
                <p class="mt-1 text-xs text-gray-500">Jadilah yang pertama menambahkan catatan kecil tentang kucing ini.</p>
            </div>
        @endforelse
    </div>
</div>
