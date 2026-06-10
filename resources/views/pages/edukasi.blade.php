<x-layouts.front-end-layout>
    <div class="relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(251,113,133,0.18),_transparent_28%),linear-gradient(180deg,_#fff7f9_0%,_#fffafc_34%,_#ffffff_72%)]">
        <div class="absolute inset-x-0 top-0 h-64 bg-gradient-to-b from-pink-100/50 to-transparent"></div>
        <div class="absolute -right-12 top-12 h-60 w-60 rounded-full bg-pink-200/40 blur-3xl"></div>
        <div class="absolute -left-8 top-36 h-48 w-48 rounded-full bg-amber-100/40 blur-3xl"></div>
        <div class="absolute right-0 top-[28rem] h-56 w-56 rounded-full bg-rose-100/40 blur-3xl"></div>

        <section class="relative">
            <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-3xl text-center">
                    <h1 class="mt-6 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl lg:text-5xl">
                        Cerita kegiatan dan
                        <span class="text-pink-500">insight edukasi</span>
                        seputar kucing kampus
                    </h1>
                    <p class="mt-5 text-base leading-7 text-gray-600 sm:text-lg">
                        Lihat aktivitas terbaru komunitas, update hasil donasi, dan cerita lapangan, lalu lanjut baca artikel singkat yang bisa bantu kamu memahami perawatan kucing dengan lebih tepat.
                    </p>
                </div>
            </div>
        </section>

        <section class="relative pb-16">
            <div class="mx-auto max-w-7xl px-4 pt-12 sm:px-6 lg:px-8">
            <div id="kegiatan" class="mb-8 scroll-mt-24">
                <div class="flex flex-col gap-4 rounded-[2rem] border border-pink-100 bg-gradient-to-r from-pink-50 via-white to-rose-50 p-6 shadow-sm sm:p-8 lg:flex-row lg:items-end lg:justify-between">
                    <div class="text-center lg:max-w-3xl lg:text-left">
                        <p class="text-sm font-semibold text-pink-500">Yuk, lihat aktivitas di JagaSatwa</p>
                        <h2 class="mt-1 text-3xl font-extrabold text-gray-900">Kegiatan dan Informasi Komunitas</h2>
                    </div>
                    <div class="text-center lg:text-right">
                        <span class="inline-flex items-center rounded-full bg-white px-4 py-2 text-xs font-semibold text-pink-600 shadow-sm ring-1 ring-pink-100">
                            {{ $semuaKegiatan->count() }} postingan
                        </span>
                        <p class="mt-2 text-xs text-gray-400">Geser ke samping untuk lihat lebih banyak</p>
                    </div>
                </div>
            </div>

            @if($semuaKegiatan->isNotEmpty())
                <div class="-mx-4 flex gap-5 overflow-x-auto px-4 pb-3 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    @foreach($semuaKegiatan as $item)
                        <a
                            href="{{ route('kegiatan.show', $item) }}"
                            class="w-[85vw] max-w-sm shrink-0 overflow-hidden rounded-[1.75rem] border border-gray-100 bg-white text-left shadow-sm transition hover:-translate-y-1 hover:border-pink-200 hover:shadow-lg sm:w-[24rem]"
                        >
                            <div class="aspect-[16/10] overflow-hidden bg-gradient-to-br from-pink-100 via-rose-50 to-amber-50">
                                @if(($item->cover_image[0] ?? null))
                                    <img
                                        src="{{ route('media.public', ['path' => $item->cover_image[0]]) }}"
                                        alt="{{ $item->judul }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="h-full w-full object-cover object-center bg-white"
                                    >
                                @else
                                    <div class="flex h-full items-center justify-center text-6xl text-pink-300">🖼️</div>
                                @endif
                            </div>

                            <div class="p-5">
                                <div class="flex items-start justify-between gap-3">
                                    <h3 class="text-lg font-extrabold text-gray-900">{{ $item->judul }}</h3>
                                    @if($item->is_featured)
                                        <span class="rounded-full bg-pink-100 px-2.5 py-1 text-[11px] font-semibold text-pink-600">Unggulan</span>
                                    @endif
                                </div>
                                <p class="mt-3 text-sm leading-6 text-gray-500">
                                    {{ \Illuminate\Support\Str::limit($item->ringkasan ?: $item->deskripsi ?: 'Informasi komunitas akan ditampilkan di sini.', 120) }}
                                </p>
                                <div class="mt-4 flex flex-wrap items-center gap-2 text-xs font-semibold">
                                    @if($item->tanggal_kegiatan)
                                        <span class="rounded-full bg-gray-100 px-3 py-1.5 text-gray-600">{{ $item->tanggal_kegiatan->format('d M Y') }}</span>
                                    @endif
                                    <span class="rounded-full bg-pink-50 px-3 py-1.5 text-pink-600">{{ $item->komentar_postingan_count }} komentar</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="rounded-[2rem] border border-dashed border-pink-200 bg-pink-50/70 p-10 text-center">
                    <p class="text-sm font-semibold text-gray-700">Belum ada informasi komunitas yang dipublikasikan.</p>
                    <p class="mt-1 text-sm text-gray-500">Admin bisa menambahkan kegiatan atau update komunitas dari panel Filament.</p>
                </div>
            @endif

            <div id="edukasi" class="mb-8 mt-16 scroll-mt-24">
                <div class="flex flex-col gap-4 rounded-[2rem] border border-pink-100 bg-gradient-to-r from-pink-50 via-white to-rose-50 p-6 shadow-sm sm:p-8 lg:flex-row lg:items-end lg:justify-between">
                    <div class="text-center lg:max-w-3xl lg:text-left">
                        <p class="text-sm font-semibold text-pink-500">Yuk, baca informasi edukasi tentang kucing</p>
                        <h2 class="mt-1 text-3xl font-extrabold text-gray-900">Insight Informasi</h2>
                    </div>
                    <div class="text-center lg:text-right">
                        <span class="inline-flex items-center rounded-full bg-white px-4 py-2 text-xs font-semibold text-pink-600 shadow-sm ring-1 ring-pink-100">
                            {{ $semuaEdukasi->count() }} artikel
                        </span>
                        <p class="mt-2 text-xs text-gray-400">Geser ke samping untuk baca artikel lainnya</p>
                    </div>
                </div>
            </div>

            @if($semuaEdukasi->isNotEmpty())
                <div class="-mx-4 flex gap-5 overflow-x-auto px-4 pb-3 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    @foreach($semuaEdukasi as $item)
                        <a
                            href="{{ route('edukasi.show', $item) }}"
                            class="flex w-[88vw] max-w-2xl shrink-0 flex-col gap-5 rounded-[1.75rem] border border-gray-100 bg-white p-5 text-left shadow-sm transition hover:-translate-y-1 hover:border-pink-200 hover:shadow-lg sm:w-[38rem] md:flex-row"
                        >
                            <div class="h-40 w-full shrink-0 overflow-hidden rounded-[1.25rem] bg-gradient-to-br from-pink-100 via-rose-50 to-amber-50 md:h-32 md:w-48">
                                @if(($item->cover_image[0] ?? null))
                                    <img
                                        src="{{ route('media.public', ['path' => $item->cover_image[0]]) }}"
                                        alt="{{ $item->judul }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="h-full w-full object-cover object-center bg-white"
                                    >
                                @else
                                    <div class="flex h-full items-center justify-center text-5xl text-pink-300">🖼️</div>
                                @endif
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="rounded-full bg-pink-100 px-2.5 py-1 text-[11px] font-semibold text-pink-600">
                                        {{ $item->kategori ?: 'Edukasi' }}
                                    </span>
                                    @if($item->published_at)
                                        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-[11px] font-semibold text-gray-600">
                                            {{ $item->published_at->format('d M Y') }}
                                        </span>
                                    @endif
                                    <span class="rounded-full bg-pink-50 px-2.5 py-1 text-[11px] font-semibold text-pink-600">
                                        {{ $item->komentar_postingan_count }} komentar
                                    </span>
                                </div>
                                <h3 class="mt-3 text-xl font-extrabold text-gray-900">{{ $item->judul }}</h3>
                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    {{ \Illuminate\Support\Str::limit($item->ringkasan ?: $item->konten ?: 'Konten edukasi akan ditampilkan di sini.', 180) }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="rounded-[2rem] border border-dashed border-pink-200 bg-gradient-to-br from-pink-50 via-white to-rose-50 p-10 text-center shadow-sm">
                    <p class="text-sm font-semibold text-gray-700">Artikel edukasi belum tersedia.</p>
                    <p class="mt-1 text-sm text-gray-500">Admin belum mempublikasikan artikel edukasi.</p>
                </div>
            @endif
            </div>
        </section>
    </div>
</x-layouts.front-end-layout>
