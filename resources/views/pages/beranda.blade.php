<x-layouts.front-end-layout>
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-pink-50 via-white to-pink-50"></div>
        <div class="absolute right-0 top-20 h-72 w-72 rounded-full bg-pink-100 opacity-50 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 h-96 w-96 rounded-full bg-pink-50 opacity-50 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-16 lg:px-8 lg:py-24">
            <div class="flex flex-col items-center gap-10 lg:grid lg:grid-cols-2 lg:items-center lg:gap-10">
                <div class="text-center lg:max-w-xl lg:text-left">
                    <div class="mb-5 inline-flex items-center gap-2 rounded-full bg-pink-100 px-4 py-1.5 text-xs font-medium text-pink-600 sm:text-sm">
                        Komunitas Peduli Hewan Kampus UNESA
                    </div>
                    <h1 class="text-5xl font-extrabold leading-[0.95] tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                        Jaga<span class="text-pink-500">Satwa</span><br>
                        <span class="text-3xl font-bold text-gray-900 sm:text-4xl lg:text-5xl">UNESA</span>
                    </h1>
                    <p class="mx-auto mt-5 max-w-md text-base leading-7 text-gray-500 sm:max-w-lg sm:text-lg lg:mx-0">
                        Bersama kita jaga, rawat, dan lindungi kucing-kucing serta satwa lain  di Universitas Negeri Surabaya.
                        Setiap aksi kecilmu sangat berarti.
                    </p>
                    <div class="mt-7 grid grid-cols-2 gap-3 sm:max-w-sm lg:max-w-md">
                        <div class="rounded-2xl border border-gray-100 bg-white px-4 py-3 text-center shadow-lg shadow-gray-200/80">
                            <p class="text-xl font-bold text-pink-500 sm:text-2xl">{{ $kucingCount }}+</p>
                            <p class="text-[11px] text-gray-500 sm:text-xs">Kucing Terdaftar</p>
                        </div>
                        <div class="rounded-2xl border border-gray-100 bg-white px-4 py-3 text-center shadow-lg shadow-gray-200/80">
                            <p class="text-xl font-bold text-emerald-500 sm:text-2xl">{{ $anggotaAktifCount }}+</p>
                            <p class="text-[11px] text-gray-500 sm:text-xs">Anggota Aktif</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center lg:justify-center">
                    <div class="relative flex flex-col items-center justify-center gap-4 lg:h-96 lg:w-full lg:max-w-[460px]">
                            <img
                                src="{{ asset('images/logojagasatwa.png') }}"
                                alt="Logo JagaSatwa"
                                class="h-64 w-64 rounded-full object-cover shadow-2xl shadow-pink-100 sm:h-[22rem] sm:w-[22rem] lg:h-[23rem] lg:w-[23rem]"
                            >
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col gap-4 sm:mb-10 sm:flex-row sm:items-end sm:justify-between">
                <div class="text-center sm:text-left">
                    <p class="mb-2 text-sm font-medium text-pink-500">Yuk, lihat keseruan kita!</p>
                    <h2 class="text-3xl font-bold text-gray-900">Kegiatan dan Informasi Komunitas</h2>
                </div>
                <div class="text-center sm:text-right">
                    <a href="{{ route('edukasi') }}#kegiatan" class="inline-flex items-center gap-2 font-semibold text-pink-500 transition hover:text-pink-600">
                        Lihat semua info komunitas
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            <div class="-mx-4 flex gap-5 overflow-x-auto px-4 pb-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 md:mx-0 md:grid md:grid-cols-3 md:gap-8 md:overflow-visible md:px-0">
                @forelse($kegiatanPublik as $item)
                    <a href="{{ route('kegiatan.show', $item) }}" class="group min-w-[280px] snap-start overflow-hidden rounded-2xl border border-gray-100 bg-gray-50 transition duration-300 hover:border-pink-200 hover:bg-pink-50 hover:shadow-lg sm:min-w-[320px] md:min-w-0">
                        <div class="aspect-[16/10] overflow-hidden bg-gradient-to-br from-pink-100 via-rose-50 to-amber-50">
                            @if(($item->cover_image[0] ?? null))
                                <img
                                    src="{{ route('media.public', ['path' => $item->cover_image[0]]) }}"
                                    alt="{{ $item->judul }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="h-full w-full object-cover object-center bg-white transition duration-500 group-hover:scale-105"
                                >
                            @else
                                <div class="flex h-full items-center justify-center text-6xl text-pink-300">Ilustrasi</div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="mb-2 text-lg font-bold text-gray-900">{{ $item->judul }}</h3>
                            <p class="text-sm leading-relaxed text-gray-500">
                                {{ \Illuminate\Support\Str::limit($item->ringkasan ?: $item->deskripsi ?: 'Informasi komunitas terbaru akan tampil di sini.', 120) }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="rounded-2xl border border-dashed border-pink-200 bg-pink-50/70 p-8 text-center md:col-span-3">
                        <p class="text-sm font-semibold text-gray-700">Belum ada informasi komunitas yang dipublikasikan.</p>
                        <p class="mt-1 text-sm text-gray-500">Admin bisa menambahkan kegiatan atau update komunitas baru dari panel Filament.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col gap-4 sm:mb-10 sm:flex-row sm:items-end sm:justify-between">
                <div class="text-center sm:text-left">
                    <h2 class="mb-2 text-3xl font-bold text-gray-900">Yuk, baca insight edukasi seputar kucing dan satwa lain!</h2>
                    <p class="text-gray-500">Pelajari cara merawat dan menyayangi hewan dengan benar</p>
                </div>
                <div class="text-center sm:text-right">
                    <a href="{{ route('edukasi') }}#edukasi" class="inline-flex items-center gap-2 font-semibold text-pink-500 transition hover:text-pink-600">
                        Lihat semua edukasi
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            <div class="-mx-4 flex gap-5 overflow-x-auto px-4 pb-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 md:mx-0 md:grid md:grid-cols-2 md:gap-6 md:overflow-visible md:px-0">
                @forelse($edukasiPublik as $item)
                    <a href="{{ route('edukasi.show', $item) }}" class="flex min-w-[280px] snap-start flex-col gap-5 rounded-2xl border border-gray-100 bg-white p-5 transition hover:shadow-md sm:min-w-[340px] sm:flex-row sm:p-6 md:min-w-0">
                        <div class="h-40 w-full shrink-0 overflow-hidden rounded-2xl bg-gradient-to-br from-pink-100 via-rose-50 to-amber-50 sm:h-24 sm:w-28">
                            @if(($item->cover_image[0] ?? null))
                                <img
                                    src="{{ route('media.public', ['path' => $item->cover_image[0]]) }}"
                                    alt="{{ $item->judul }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="h-full w-full object-cover object-center bg-white"
                                >
                            @else
                                <div class="flex h-full items-center justify-center text-4xl text-pink-300">Ilustrasi</div>
                            @endif
                        </div>
                        <div>
                            <h3 class="mb-1 font-bold text-gray-900">{{ $item->judul }}</h3>
                            <p class="text-sm leading-relaxed text-gray-500">
                                {{ \Illuminate\Support\Str::limit($item->ringkasan ?: $item->konten ?: 'Konten edukasi terbaru akan tampil di sini.', 130) }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="rounded-2xl border border-dashed border-pink-200 bg-white p-8 text-center md:col-span-2">
                        <p class="text-sm font-semibold text-gray-700">Belum ada artikel edukasi yang dipublikasikan.</p>
                        <p class="mt-1 text-sm text-gray-500">Admin bisa menambahkan artikel baru dari panel Filament.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col gap-4 sm:mb-10 sm:flex-row sm:items-end sm:justify-between">
                <div class="text-center sm:text-left">
                    <h2 class="mb-2 text-3xl font-bold text-gray-900">Kenalan sama kucing-kucing kampus</h2>
                    <p class="text-gray-500">Lihat beberapa profil pilihan, lokasi muncul, dan lanjut baca detailnya</p>
                </div>
                <div class="text-center sm:text-right">
                    <a href="{{ route('kucing.public') }}" class="inline-flex items-center gap-2 font-semibold text-pink-500 transition hover:text-pink-600">
                        Lihat semua kucing
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            <div class="-mx-4 flex gap-5 overflow-x-auto px-4 pb-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 md:mx-0 md:grid md:grid-cols-2 md:gap-6 md:overflow-visible md:px-0 xl:grid-cols-4">
                @forelse($kucingPublik as $kucing)
                    @php
                        $fotoUtama = $kucing->foto[0] ?? null;
                    @endphp
                    <a href="{{ route('kucing.show', $kucing) }}" class="group min-w-[280px] snap-start overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-pink-200 hover:shadow-lg sm:min-w-[320px] md:min-w-0">
                        <div class="aspect-[4/3] overflow-hidden bg-gradient-to-br from-gray-100 via-pink-50 to-amber-50">
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
                        </div>
                        <div class="p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $kucing->nama_kucing ?: 'Tanpa nama' }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ $kucing->lokasi_kucing ?: 'Lokasi belum dicatat' }}</p>
                                </div>
                                <span class="rounded-full bg-pink-50 px-2.5 py-1 text-[11px] font-semibold text-pink-600">
                                    {{ $kucing->komentar_count }} komentar
                                </span>
                            </div>
                            <p class="mt-3 text-sm leading-relaxed text-gray-500">
                                {{ \Illuminate\Support\Str::limit($kucing->deskripsi ?: 'Profil singkat kucing kampus akan tampil di sini.', 110) }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="rounded-2xl border border-dashed border-pink-200 bg-pink-50/70 p-8 text-center xl:col-span-4">
                        <p class="text-sm font-semibold text-gray-700">Belum ada profil kucing yang ditampilkan.</p>
                        <p class="mt-1 text-sm text-gray-500">Data kucing akan muncul di sini setelah ditambahkan oleh tim.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-pink-500 to-pink-600 p-10 text-center text-white lg:p-16">
                <div class="absolute right-0 top-0 h-64 w-64 rounded-full bg-pink-400 opacity-30 blur-3xl"></div>
                <div class="relative">
                    <h2 class="mb-4 text-3xl font-bold lg:text-4xl">Bantu Kucing Kampus Sekarang!</h2>
                    <p class="mx-auto mb-8 max-w-2xl text-lg text-pink-100">
                        Setiap donasi dan laporan kamu sangat berarti bagi kelangsungan hidup kucing-kucing di kampus UNESA.
                    </p>
                    <div class="flex flex-col justify-center gap-4 sm:flex-row">
                        <a href="{{ route('donasi.public') }}" class="w-full rounded-full bg-white px-8 py-3 text-center font-semibold text-pink-600 shadow-lg transition hover:bg-pink-50 sm:w-auto">
                            Donasi Sekarang
                        </a>
                        <a href="{{ route('lapor-kasus.public') }}" class="w-full rounded-full border-2 border-white px-8 py-3 text-center font-semibold text-white transition hover:bg-pink-400 sm:w-auto">
                            Lapor Kasus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.front-end-layout>
