<x-layouts.front-end-layout>

    <section class="relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(251,113,133,0.18),_transparent_28%),linear-gradient(180deg,_#fff7f9_0%,_#ffffff_72%)]">
        <div class="absolute inset-x-0 top-0 h-64 bg-gradient-to-b from-pink-100/50 to-transparent"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h1 class="mt-6 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl lg:text-5xl">
                    Bantu kami menindaklanjuti
                    <span class="text-pink-500">kasus kucing</span>
                    yang ada di UNESA
                </h1>
                <p class="mt-5 text-base leading-7 text-gray-600 sm:text-lg">
                    Kalau kamu menemukan kucing sakit, terluka, dibuang, atau dalam kondisi darurat lain, langsung laporkan disini yaa
                </p>
            </div>

            <div class="mx-auto mt-10 max-w-5xl space-y-6">
                <div class="rounded-[2rem] border border-pink-100 bg-white/90 p-6 shadow-xl shadow-pink-100/60 backdrop-blur sm:p-8">
                    <p class="text-sm font-semibold tracking-wide text-pink-500">
                        Contoh kasus yang bisa dilaporkan:
                    </p>

                    <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">
                        @php
                            $kasus = [
                                ['emoji' => '🤒', 'title' => 'Kucing Sakit'],
                                ['emoji' => '🩹', 'title' => 'Kucing Terluka'],
                                ['emoji' => '📦', 'title' => 'Pembuangan Kucing'],
                                ['emoji' => '😿', 'title' => 'Kucing Terlantar'],
                                ['emoji' => '🚑', 'title' => 'Kucing Tertabrak'],
                                ['emoji' => '⚠️', 'title' => 'Kasus Lainnya'],
                            ];
                        @endphp

                        @foreach($kasus as $item)
                            <div class="rounded-2xl border border-gray-100 bg-gray-50 px-3 py-5 text-center transition hover:-translate-y-0.5 hover:border-pink-200 hover:bg-pink-50">
                                <div class="mx-auto mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-2xl shadow-sm">
                                    {{ $item['emoji'] }}
                                </div>
                                <p class="text-sm font-semibold text-gray-900">{{ $item['title'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="-mx-4 flex gap-5 overflow-x-auto px-4 pb-3 sm:-mx-6 sm:px-6 lg:mx-0 lg:grid lg:grid-cols-3 lg:gap-5 lg:overflow-visible lg:px-0 lg:pb-0">
                    @forelse($contohLaporanKasus as $item)
                        <article class="w-[82vw] max-w-sm shrink-0 overflow-hidden rounded-[1.75rem] border border-gray-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg lg:w-auto lg:max-w-none">
                            <div class="aspect-[16/10] bg-gradient-to-br from-pink-100 via-rose-50 to-amber-50">
                                @if(!empty($item['foto']))
                                    <img
                                        src="{{ route('media.public', ['path' => $item['foto']]) }}"
                                        alt="{{ $item['judul'] }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="h-full w-full object-cover object-center"
                                    >
                                @else
                                    <div class="flex h-full items-center justify-center text-6xl text-pink-300">🖼️</div>
                                @endif
                            </div>

                            <div class="p-5">
                                <div class="flex items-start justify-between gap-3">
                                    <span class="inline-flex rounded-full bg-pink-100 px-3 py-1 text-xs font-semibold text-pink-700">
                                        {{ $item['kategori'] }}
                                    </span>
                                </div>

                                <h3 class="mt-4 text-xl font-extrabold leading-7 text-gray-900">{{ $item['judul'] }}</h3>
                                <p class="mt-2 text-sm leading-6 text-gray-600">{{ $item['deskripsi'] }}</p>

                                <div class="mt-4 grid gap-3 rounded-2xl bg-gray-50 p-4">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Lokasi</p>
                                        <p class="mt-1 text-sm font-medium text-gray-800">{{ $item['lokasi'] }}</p>
                                    </div>

                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Tindakan</p>
                                        <p class="mt-1 text-sm leading-6 text-gray-700">{{ $item['tindakan'] }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-wrap gap-2 text-[11px] text-gray-400">
                                    @if(!empty($item['tanggal']))
                                        <span class="inline-flex items-center gap-1 rounded-full bg-white px-3 py-1 shadow-sm">Dilaporkan {{ $item['tanggal'] }}</span>
                                    @endif
                                    @if(!empty($item['status']))
                                        <span class="inline-flex items-center gap-1 rounded-full bg-pink-50 px-3 py-1 font-semibold text-pink-600">{{ $item['status'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="w-[82vw] max-w-sm shrink-0 rounded-3xl border border-dashed border-pink-200 bg-pink-50/50 p-8 text-center lg:col-span-3 lg:w-auto lg:max-w-none">
                            <p class="text-sm font-semibold text-gray-800">Belum ada laporan kasus yang ditampilkan ke publik.</p>
                            <p class="mt-2 text-sm leading-6 text-gray-500">
                                Kalau sudah ada laporan asli, admin tinggal menyalakan toggle <code>Tampilkan di halaman publik</code> pada laporan yang ingin dibuka ke pengunjung.
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </section>

    <section class="bg-white pb-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @auth
                <livewire:lapor-kasus-form />
            @else
                <div class="mx-auto max-w-4xl overflow-hidden rounded-[2rem] border border-gray-200 bg-white shadow-xl shadow-gray-100">
                    <div class="grid lg:grid-cols-[0.95fr,1.05fr]">
                        <div class="bg-pink-500 p-8 text-white sm:p-10">
                            <h3 class="mt-5 text-3xl font-extrabold leading-tight">Satu langkah lagi sebelum kirim laporan.</h3>
                        </div>

                        <div class="p-8 sm:p-10">
                            <h4 class="mt-2 text-2xl font-extrabold text-gray-900">Masuk untuk lanjut isi laporan</h4>
                            <p class="mt-3 text-sm leading-6 text-gray-500">
                                Login atau daftar akun untuk menyimpan laporan dan memantau statusnya nanti. Setelah masuk, kamu akan langsung kembali ke halaman ini.
                            </p>

                            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                                <a href="{{ route('login', ['redirect_to' => route('lapor-kasus.public', absolute: false)]) }}"
                                   class="inline-flex items-center justify-center rounded-full bg-pink-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600">
                                    Login Sekarang
                                </a>
                                <a href="{{ route('register', ['redirect_to' => route('lapor-kasus.public', absolute: false)]) }}"
                                   class="inline-flex items-center justify-center rounded-full border-2 border-pink-500 px-7 py-3 text-sm font-semibold text-pink-500 transition hover:bg-pink-50">
                                    Daftar Akun
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </section>

</x-layouts.front-end-layout>
