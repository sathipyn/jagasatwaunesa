<x-layouts.front-end-layout>
    <section class="relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(251,113,133,0.18),_transparent_28%),linear-gradient(180deg,_#fff7f9_0%,_#ffffff_72%)]">
        <div class="absolute inset-x-0 top-0 h-64 bg-gradient-to-b from-pink-100/50 to-transparent"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h1 class="mt-6 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl lg:text-5xl">
                    Donasi untuk
                    <span class="text-pink-500">satwa kampus</span>
                    yang butuh bantuan
                </h1>
                <p class="mt-5 text-base leading-7 text-gray-600 sm:text-lg">
                    Setiap transfer yang kamu kirim membantu kebutuhan pakan, pengobatan, sterilisasi, dan vaksinasi kucing binaan JagaSatwa UNESA.
                </p>
            </div>

            <div class="mx-auto mt-10 max-w-3xl rounded-[1.75rem] border border-pink-100 bg-white/90 p-5 shadow-xl shadow-pink-100/60 backdrop-blur sm:p-6">
                <p class="text-center text-xl font-extrabold text-gray-900">Donasi akan digunakan untuk apa?</p>

                <div class="mt-7 grid grid-cols-2 gap-x-3 gap-y-5 sm:grid-cols-3 lg:grid-cols-6">
                    @php
                        $programDonasi = [
                            ['title' => 'Pakan', 'emoji' => '🍽️'],
                            ['title' => 'Sterilisasi', 'emoji' => '✂️'],
                            ['title' => 'Pengobatan', 'emoji' => '💊'],
                            ['title' => 'Vaksinasi', 'emoji' => '💉'],
                            ['title' => 'Rescue', 'emoji' => '🚑'],
                            ['title' => 'Lainnya', 'emoji' => '🐾'],
                        ];
                    @endphp

                    @foreach($programDonasi as $item)
                        <div class="flex flex-col items-center text-center">
                            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full border border-gray-300 bg-white text-2xl shadow-sm">
                                {{ $item['emoji'] }}
                            </div>
                            <p class="mt-2 text-xs font-semibold text-gray-800 sm:text-sm">{{ $item['title'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <section class="bg-white pb-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @auth
                <livewire:donasi-form />
            @else
                <div class="mx-auto max-w-4xl overflow-hidden rounded-[2rem] border border-gray-200 bg-white shadow-xl shadow-gray-100">
                    <div class="grid lg:grid-cols-[0.95fr,1.05fr]">
                        <div class="bg-pink-600 p-8 text-white sm:p-10">
                            <h3 class="text-3xl font-extrabold leading-tight">Satu langkah lagi sebelum kirim konfirmasi donasi.</h3>
                            <p class="mt-4 text-sm leading-6 text-white/90">
                                Login atau buat akun supaya bukti transfer dan riwayat donasimu tersimpan rapi.
                            </p>
                        </div>

                        <div class="p-8 sm:p-10">
                            <p class="text-sm font-semibold text-pink-500">Akses form donasi</p>
                            <h4 class="mt-2 text-2xl font-extrabold text-gray-900">Masuk untuk kirim bukti transfer</h4>
                            <p class="mt-3 text-sm leading-6 text-gray-500">
                                Setelah login atau registrasi, kamu akan kembali ke halaman donasi ini dan bisa langsung lanjut isi form.
                            </p>

                            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                                <a href="{{ route('login', ['redirect_to' => route('donasi.public', absolute: false)]) }}"
                                   class="inline-flex items-center justify-center rounded-full bg-pink-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600">
                                    Login Sekarang
                                </a>
                                <a href="{{ route('register', ['redirect_to' => route('donasi.public', absolute: false)]) }}"
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
