<x-layouts.front-end-layout>
    @php
        $fotoKucing = collect($kucing->foto ?? [])
            ->filter()
            ->values()
            ->map(fn ($path) => route('media.public', ['path' => $path]))
            ->all();
    @endphp

    <section class="bg-[linear-gradient(180deg,_#fff7f9_0%,_#ffffff_70%)] py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <a href="{{ route('kucing.public') }}" class="inline-flex items-center text-sm font-semibold text-pink-600 hover:text-pink-700">
                Kembali ke data kucing
            </a>

            <div class="mt-6 grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-start">
                <div class="overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-xl shadow-pink-100/40">
                    <div
                        x-data="{ photos: @js($fotoKucing), currentIndex: 0 }"
                        class="relative aspect-[4/3] bg-gradient-to-br from-pink-100 via-rose-50 to-amber-50"
                    >
                        @if(! empty($fotoKucing))
                            <template x-for="(photo, index) in photos" :key="photo">
                                <img
                                    x-show="currentIndex === index"
                                    x-transition.opacity
                                    :src="photo"
                                    alt="{{ $kucing->nama_kucing ?: 'Foto kucing' }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="absolute inset-0 h-full w-full object-cover object-center bg-white"
                                >
                            </template>

                            @if(count($fotoKucing) > 1)
                                <button
                                    type="button"
                                    @click="currentIndex = currentIndex === 0 ? photos.length - 1 : currentIndex - 1"
                                    class="absolute left-4 top-1/2 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-lg font-bold text-gray-700 shadow-sm transition hover:bg-white"
                                    aria-label="Foto sebelumnya"
                                >
                                    ‹
                                </button>
                                <button
                                    type="button"
                                    @click="currentIndex = currentIndex === photos.length - 1 ? 0 : currentIndex + 1"
                                    class="absolute right-4 top-1/2 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-lg font-bold text-gray-700 shadow-sm transition hover:bg-white"
                                    aria-label="Foto berikutnya"
                                >
                                    ›
                                </button>

                                <div class="absolute bottom-4 left-1/2 flex -translate-x-1/2 items-center gap-2 rounded-full bg-black/25 px-3 py-2 backdrop-blur-sm">
                                    <template x-for="(photo, index) in photos" :key="`${photo}-dot`">
                                        <button
                                            type="button"
                                            @click="currentIndex = index"
                                            class="h-2.5 w-2.5 rounded-full transition"
                                            :class="currentIndex === index ? 'bg-white' : 'bg-white/45'"
                                            :aria-label="`Lihat foto ${index + 1}`"
                                        ></button>
                                    </template>
                                </div>
                            @endif
                        @else
                            <div class="flex h-full items-center justify-center text-5xl font-bold text-pink-300">
                                JagaSatwa
                            </div>
                        @endif
                    </div>
                </div>

                <div class="rounded-[2rem] border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                    <div class="flex flex-wrap gap-2">
                        @if($kucing->open_adopsi)
                            <span class="rounded-full bg-pink-500 px-3 py-1.5 text-xs font-semibold text-white">Bisa diadopsi</span>
                        @endif
                        <span class="rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-600">{{ $kucing->jenis_kelamin ?: 'Jenis kelamin belum dicatat' }}</span>
                        <span class="rounded-full bg-pink-50 px-3 py-1.5 text-xs font-semibold text-pink-600">{{ $kucing->komentar_count }} komentar</span>
                    </div>

                    <h1 class="mt-5 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl">
                        {{ $kucing->nama_kucing ?: 'Tanpa nama' }}
                    </h1>
                    <p class="mt-4 text-base leading-7 text-gray-600">
                        {{ $kucing->deskripsi ?: 'Belum ada deskripsi tambahan untuk profil kucing ini.' }}
                    </p>

                    <dl class="mt-7 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <dt class="text-xs font-semibold uppercase text-gray-400">Lokasi</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-800">{{ $kucing->lokasi_kucing ?: 'Belum dicatat' }}</dd>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <dt class="text-xs font-semibold uppercase text-gray-400">Warna</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-800">{{ $kucing->warna_kucing ?: 'Belum dicatat' }}</dd>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <dt class="text-xs font-semibold uppercase text-gray-400">Steril</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-800">{{ $kucing->steril_kucing ?: 'Belum diketahui' }}</dd>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <dt class="text-xs font-semibold uppercase text-gray-400">Vaksin</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-800">{{ $kucing->vaksin_kucing ?: 'Belum diketahui' }}</dd>
                        </div>
                    </dl>

                    @if($kucing->open_adopsi)
                        <a href="{{ route('adopsi.public', ['kucing' => $kucing->id]) }}" class="mt-7 inline-flex items-center justify-center rounded-full bg-pink-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600">
                            Ajukan adopsi
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white pb-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <livewire:kucing-komentar :kucing="$kucing" />
        </div>
    </section>
</x-layouts.front-end-layout>
