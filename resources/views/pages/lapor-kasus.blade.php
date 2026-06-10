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
                    <p class="flex items-center gap-2 text-sm font-semibold text-pink-500">
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
            </div>
        </div>
    </section>

    <section class="bg-white pb-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @auth
                <livewire:lapor-kasus-form />
            @else
                <div class="mx-auto max-w-4xl overflow-hidden rounded-[2rem] border border-gray-200 bg-white shadow-xl shadow-gray-100">
                    <div class="grid lg:grid-cols-[0.1fr,5.0fr]">
                        <div class="bg-pink-500 p-8 text-white sm:p-10">
                            <h3 class="mt-5 text-3xl font-extrabold leading-tight">Satu langkah lagi sebelum kirim laporan.</h3>
                        </div>

                        <div class="p-8 sm:p-10">
                            <h4 class="mt-2 text-2xl font-extrabold text-gray-900">Masuk untuk lanjut isi laporan</h4>
                            <p class="mt-3 text-sm leading-6 text-gray-500">
                                Login atau daftar akun untuk menyimpan laporan dan memantau statusnya nanti. Setelah masuk, kamu akan langsung kembali ke halaman ini.

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
