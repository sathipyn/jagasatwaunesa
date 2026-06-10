<x-layouts.front-end-layout>
    <section class="relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(251,113,133,0.18),_transparent_28%),linear-gradient(180deg,_#fff7f9_0%,_#ffffff_72%)]">
        <div class="absolute inset-x-0 top-0 h-64 bg-gradient-to-b from-pink-100/50 to-transparent"></div>
        <div class="absolute -right-12 top-12 h-60 w-60 rounded-full bg-pink-200/40 blur-3xl"></div>
        <div class="absolute -left-8 top-36 h-48 w-48 rounded-full bg-amber-100/40 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h1 class="text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl lg:text-5xl">
                    Yuk, kenalan dengan
                    <span class="text-pink-500">kucing-kucing</span>
                    kampus UNESA
                </h1>
                <p class="mt-5 text-base leading-7 text-gray-600 sm:text-lg">
                    Lihat profil singkat, lokasi biasa muncul, dan status kesehatannya. Sebagian dari mereka juga sedang membuka kesempatan untuk diadopsi.
                </p>
            </div>

            <div class="mx-auto mt-10 grid max-w-4xl grid-cols-3 gap-3 sm:gap-4">
                <div class="rounded-2xl border border-white/70 bg-white/85 px-3 py-4 text-center shadow-sm backdrop-blur sm:p-5">
                    <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl">{{ $semuaKucing->count() }}</p>
                    <p class="mt-1 text-[11px] leading-4 text-gray-500 sm:text-sm">Total kucing terdata</p>
                </div>
                <div class="rounded-2xl border border-white/70 bg-white/85 px-3 py-4 text-center shadow-sm backdrop-blur sm:p-5">
                    <p class="text-2xl font-extrabold text-pink-500 sm:text-3xl">{{ $kucingOpenAdopsi->count() }}</p>
                    <p class="mt-1 text-[11px] leading-4 text-gray-500 sm:text-sm">Open adopsi</p>
                </div>
                <div class="rounded-2xl border border-white/70 bg-white/85 px-3 py-4 text-center shadow-sm backdrop-blur sm:p-5">
                    <p class="text-2xl font-extrabold text-emerald-500 sm:text-3xl">{{ $kucingSteril->count() }}</p>
                    <p class="mt-1 text-[11px] leading-4 text-gray-500 sm:text-sm">Sudah steril</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white pb-16">
        <div class="mx-auto max-w-7xl px-4 pt-12 sm:px-6 lg:px-8">
            @if($semuaKucing->isNotEmpty())
                <div class="rounded-[2rem] border border-pink-100 bg-white p-6 shadow-xl shadow-pink-100/40 sm:p-8">
                    <div class="flex flex-col gap-3 border-b border-gray-100 pb-6 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <h2 class="mt-1 text-2xl font-extrabold text-gray-900">Kucing kampus yang siap diadopsi</h2>
                            <p class="mt-2 text-sm leading-6 text-gray-500">
                                Lihat beberapa profil kucing yang sedang membuka kesempatan untuk punya rumah baru.
                            </p>
                        </div>
                        <a href="{{ route('adopsi.public') }}" class="inline-flex w-full items-center justify-center rounded-full border border-pink-200 bg-pink-50 px-5 py-2.5 text-center text-sm font-semibold text-pink-600 transition hover:bg-pink-100 sm:w-auto">
                            Buka form adopsi & Lihat riwayat permintaan
                        </a>
                    </div>

                    @if($wallOfFameKucing->isNotEmpty())
                        <div class="mt-6 grid grid-cols-2 items-start gap-3 sm:gap-5 xl:grid-cols-4">
                            @foreach($wallOfFameKucing as $kucing)
                                @php
                                    $fotoUtama = $kucing->foto[0] ?? null;
                                @endphp
                                <article class="group flex flex-col overflow-hidden rounded-[1.4rem] border border-gray-100 bg-white shadow-sm transition hover:-translate-y-1 hover:border-pink-200 hover:shadow-lg sm:rounded-[1.75rem]">
                                    <div class="relative aspect-[3/4] overflow-hidden bg-gradient-to-br from-pink-100 via-rose-50 to-amber-50 sm:aspect-[4/3] xl:aspect-[5/4]">
                                        @if($fotoUtama)
                                            <img
                                                src="{{ route('media.public', ['path' => $fotoUtama]) }}"
                                                alt="{{ $kucing->nama_kucing ?: 'Foto kucing' }}"
                                                loading="lazy"
                                                decoding="async"
                                                class="h-full w-full object-cover object-center bg-white transition duration-500 group-hover:scale-105"
                                            >
                                        @else
                                            <div class="flex h-full items-center justify-center text-5xl text-gray-400">Kucing</div>
                                        @endif

                                        <div class="absolute left-3 top-3 flex flex-wrap gap-1.5 sm:left-4 sm:top-4 sm:gap-2">
                                            <span class="rounded-full bg-pink-500 px-2.5 py-1 text-[10px] font-semibold text-white shadow-sm sm:px-3 sm:text-[11px]">Open adopsi</span>
                                            @if($kucing->jenis_kelamin)
                                                <span class="rounded-full bg-white/90 px-2.5 py-1 text-[10px] font-semibold text-gray-700 sm:px-3 sm:text-[11px]">
                                                    {{ $kucing->jenis_kelamin }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex flex-col p-3.5 sm:p-5">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <h3 class="text-base font-extrabold text-gray-900 sm:text-lg">
                                                    {{ $kucing->nama_kucing ?: 'Tanpa nama' }}
                                                </h3>
                                                <p class="mt-1 truncate text-xs text-gray-500 sm:text-sm">{{ $kucing->lokasi_kucing ?: 'Lokasi belum dicatat' }}</p>
                                            </div>
                                            <span class="inline-flex h-7 w-7 items-center justify-center rounded-2xl bg-pink-100 text-[11px] font-bold text-pink-600 sm:h-8 sm:w-8">
                                                {{ $loop->iteration }}
                                            </span>
                                        </div>

                                        <div class="mt-3 flex min-h-[3rem] flex-wrap content-start gap-1.5 sm:mt-4 sm:gap-2">
                                            <span class="rounded-full bg-gray-100 px-2.5 py-1 text-[11px] font-semibold text-gray-600">
                                                {{ $kucing->warna_kucing ?: 'Warna belum dicatat' }}
                                            </span>
                                            <span class="rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $kucing->steril_kucing === 'Sudah' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                                Steril: {{ $kucing->steril_kucing ?: 'N/A' }}
                                            </span>
                                            <span class="rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $kucing->vaksin_kucing === 'Sudah' ? 'bg-sky-100 text-sky-700' : 'bg-gray-100 text-gray-600' }}">
                                                Vaksin: {{ $kucing->vaksin_kucing ?: 'N/A' }}
                                            </span>
                                        </div>

                                        <p class="mt-3 truncate text-xs leading-5 text-gray-500 sm:mt-4 sm:text-sm sm:leading-6">
                                            {{ \Illuminate\Support\Str::limit($kucing->deskripsi ?: 'Profil kucing ini akan segera diperbarui oleh tim JagaSatwa.', 44) }}
                                        </p>

                                        <div class="pt-3 sm:pt-4">
                                            <a href="{{ route('adopsi.public', ['kucing' => $kucing->id]) }}" class="inline-flex w-full items-center justify-center rounded-full bg-pink-500 px-4 py-2 text-[11px] font-semibold text-white transition hover:bg-pink-600 sm:text-xs">
                                                Ajukan adopsi
                                            </a>
                                            <a href="{{ route('kucing.show', $kucing) }}" class="mt-2 inline-flex w-full items-center justify-center rounded-full border border-pink-200 px-4 py-2 text-[11px] font-semibold text-pink-600 transition hover:bg-pink-50 sm:text-xs">
                                                Detail & komentar
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="mt-6 rounded-2xl border border-dashed border-pink-200 bg-pink-50/60 p-5 text-center">
                            <p class="text-sm font-semibold text-gray-700">Belum ada kucing yang open adopsi.</p>
                            <p class="mt-1 text-xs text-gray-500">Nanti profil yang siap diadopsi akan tampil di sini.</p>
                        </div>
                    @endif
                </div>

                <div class="mt-12">
                    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold text-pink-500">Data lengkap</p>
                            <h2 class="mt-1 text-3xl font-extrabold text-gray-900">Kucing Kampus UNESA</h2>
                            <p class="mt-2 text-sm leading-6 text-gray-500">
                                Semua data yang sudah dicatat tim, mulai dari lokasi, warna, sampai status kesehatan dasar.
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-2 text-xs font-semibold">
                            <span class="rounded-full bg-pink-100 px-3 py-1.5 text-pink-600">{{ $hasilKucing->count() }} hasil</span>
                            <span class="rounded-full bg-gray-100 px-3 py-1.5 text-gray-600">{{ $semuaKucing->count() }} total profil</span>
                            <span class="rounded-full bg-emerald-100 px-3 py-1.5 text-emerald-700">{{ $kucingSteril->count() }} steril</span>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('kucing.public') }}" class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
                        <div class="w-full sm:w-[280px]">
                            <label for="cari-kucing" class="sr-only">Sequential Search</label>
                            <input
                                id="cari-kucing"
                                type="search"
                                name="cari"
                                value="{{ $kataKunci }}"
                                class="h-10 w-full rounded-lg border border-gray-200 bg-white px-4 text-sm outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200"
                                placeholder="Search"
                            >
                        </div>
                        <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-pink-500 px-5 text-sm font-semibold text-white transition hover:bg-pink-600">
                            Cari
                        </button>
                        @if($kataKunci !== '')
                            <a href="{{ route('kucing.public') }}" class="inline-flex h-10 items-center justify-center rounded-lg border border-pink-200 bg-white px-5 text-sm font-semibold text-pink-600 transition hover:bg-pink-50">
                                Reset
                            </a>
                        @endif
                    </form>

                    @if($hasilKucing->isNotEmpty())
                        <div class="grid grid-cols-2 items-start gap-3 sm:gap-5 xl:grid-cols-4">
                            @foreach($hasilKucing as $kucing)
                                @php
                                    $fotoUtama = $kucing->foto[0] ?? null;
                                @endphp
                                <article class="group flex flex-col overflow-hidden rounded-[1.4rem] border border-gray-100 bg-white shadow-sm transition hover:-translate-y-1 hover:border-pink-200 hover:shadow-lg sm:rounded-[1.75rem]">
                                    <div class="relative aspect-[3/4] overflow-hidden bg-gradient-to-br from-gray-100 via-pink-50 to-amber-50 sm:aspect-[4/3] xl:aspect-[5/4]">
                                        @if($fotoUtama)
                                            <img
                                                src="{{ route('media.public', ['path' => $fotoUtama]) }}"
                                                alt="{{ $kucing->nama_kucing ?: 'Foto kucing' }}"
                                                loading="lazy"
                                                decoding="async"
                                                class="h-full w-full object-cover object-center bg-white transition duration-500 group-hover:scale-105"
                                            >
                                        @else
                                            <div class="flex h-full items-center justify-center text-5xl text-gray-400">Kucing</div>
                                        @endif

                                        @if($kucing->open_adopsi)
                                            <span class="absolute right-3 top-3 rounded-full bg-pink-500 px-2.5 py-1 text-[10px] font-semibold text-white shadow-sm sm:right-4 sm:top-4 sm:px-3 sm:text-[11px]">
                                                Bisa diadopsi
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex flex-col p-3.5 sm:p-5">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <h3 class="text-base font-extrabold text-gray-900 sm:text-lg">{{ $kucing->nama_kucing ?: 'Tanpa nama' }}</h3>
                                                <p class="mt-1 truncate text-xs text-gray-500 sm:text-sm">{{ $kucing->lokasi_kucing ?: 'Lokasi belum dicatat' }}</p>
                                            </div>
                                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-2xl bg-pink-100 text-xs font-bold text-pink-600 sm:h-9 sm:w-9 sm:text-sm">
                                                {{ $loop->iteration }}
                                            </span>
                                        </div>

                                        <div class="mt-3 flex min-h-[3rem] flex-wrap content-start gap-1.5 sm:mt-4 sm:gap-2">
                                            <span class="rounded-full bg-gray-100 px-2.5 py-1 text-[11px] font-semibold text-gray-600">
                                                {{ $kucing->jenis_kelamin ?: 'Tidak diketahui' }}
                                            </span>
                                            <span class="rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $kucing->steril_kucing === 'Sudah' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                                Steril: {{ $kucing->steril_kucing ?: 'N/A' }}
                                            </span>
                                            <span class="rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $kucing->vaksin_kucing === 'Sudah' ? 'bg-sky-100 text-sky-700' : 'bg-gray-100 text-gray-600' }}">
                                                Vaksin: {{ $kucing->vaksin_kucing ?: 'N/A' }}
                                            </span>
                                        </div>

                                        <p class="mt-3 truncate text-xs leading-5 text-gray-500 sm:mt-4 sm:text-sm sm:leading-6">
                                            {{ \Illuminate\Support\Str::limit($kucing->deskripsi ?: 'Belum ada deskripsi tambahan untuk profil kucing ini.', 44) }}
                                        </p>

                                        <div class="mt-3 border-t border-gray-100 pt-3 text-[11px] text-gray-500 sm:mt-4 sm:pt-4 sm:text-xs">
                                            <p class="truncate"><span class="font-semibold text-gray-700">Warna:</span> {{ $kucing->warna_kucing ?: 'Belum dicatat' }}</p>
                                        </div>

                                        <div class="pt-3 sm:pt-4">
                                            <div class="flex items-center justify-between gap-3">
                                                <span class="text-[11px] font-semibold text-gray-400 sm:text-xs">{{ $kucing->komentar_count }} komentar</span>
                                                @if($kucing->open_adopsi)
                                                    <span class="text-[11px] font-semibold text-pink-500 sm:text-xs">Open adopsi</span>
                                                @endif
                                            </div>
                                            <a href="{{ route('kucing.show', $kucing) }}" class="mt-2 inline-flex w-full items-center justify-center rounded-full border border-pink-200 px-3 py-2 text-[11px] font-semibold text-pink-600 transition hover:bg-pink-50 sm:px-4 sm:text-xs">
                                                Detail & komentar
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="rounded-[1.75rem] border border-dashed border-pink-200 bg-pink-50/60 p-8 text-center">
                            <p class="text-sm font-semibold text-gray-700">Data kucing tidak ditemukan.</p>
                            <p class="mt-1 text-xs text-gray-500">Coba gunakan kata kunci lain yang lebih umum.</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="rounded-[2rem] border border-dashed border-pink-200 bg-gradient-to-br from-pink-50 via-white to-rose-50 p-10 text-center shadow-sm">
                    <div class="mx-auto inline-flex h-16 w-16 items-center justify-center rounded-full bg-pink-100 text-3xl">Kucing</div>
                    <h2 class="mt-5 text-2xl font-extrabold text-gray-900">Data kucing belum tersedia</h2>
                    <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-gray-500">
                        Tim JagaSatwa belum menambahkan profil kucing ke halaman ini. Sementara itu, kamu tetap bisa bantu lewat donasi atau melaporkan kasus yang perlu ditangani.
                    </p>
                    <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                        <a href="{{ route('donasi.public') }}" class="inline-flex items-center justify-center rounded-full bg-pink-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600">
                            Kirim Donasi
                        </a>
                        <a href="{{ route('lapor-kasus.public') }}" class="inline-flex items-center justify-center rounded-full border-2 border-pink-500 px-7 py-3 text-sm font-semibold text-pink-500 transition hover:bg-pink-50">
                            Lapor Kasus
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.front-end-layout>
