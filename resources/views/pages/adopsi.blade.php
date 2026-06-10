<x-layouts.front-end-layout>
    <section class="relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(251,113,133,0.18),_transparent_28%),linear-gradient(180deg,_#fff7f9_0%,_#ffffff_72%)]">
        <div class="absolute inset-x-0 top-0 h-64 bg-gradient-to-b from-pink-100/50 to-transparent"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:pb-18">
            <div class="mx-auto max-w-3xl text-center">
                <h1 class="mt-6 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl lg:text-5xl">
                    Ajukan adopsi untuk
                    <span class="text-pink-500">kucing kampus</span>
                    yang siap punya rumah
                </h1>
                <p class="mt-5 text-base leading-7 text-gray-600 sm:text-lg">
                    Kalau kamu siap merawat dengan serius, isi form ini untuk mengajukan adopsi ke tim JagaSatwa.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-transparent pb-16">
        <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 sm:pt-8 lg:px-8 lg:pt-10">
            @auth
                <livewire:adopsi-public-form :kucing-id="request('kucing')" />
            @else
                <div class="mx-auto max-w-4xl overflow-hidden rounded-[2rem] border border-gray-200 bg-white shadow-xl shadow-gray-100">
                    <div class="grid lg:grid-cols-[0.95fr,1.05fr]">
                        <div class="bg-gradient-to-br from-pink-500 via-rose-500 to-orange-400 p-8 text-white sm:p-10">
                            <h3 class="text-3xl font-extrabold leading-tight">Satu langkah lagi sebelum kirim pengajuan adopsi.</h3>
                            <p class="mt-4 text-sm leading-6 text-white/90">
                                Login atau buat akun supaya pengajuanmu tercatat rapi dan statusnya bisa dipantau.
                            </p>
                        </div>

                        <div class="p-8 sm:p-10">
                            <p class="text-sm font-semibold text-pink-500">Akses form adopsi</p>
                            <h4 class="mt-2 text-2xl font-extrabold text-gray-900">Masuk untuk lanjut ajukan adopsi</h4>
                            <p class="mt-3 text-sm leading-6 text-gray-500">
                                Setelah login atau registrasi, kamu akan kembali ke halaman ini dan bisa langsung isi pengajuan adopsi.
                            </p>

                            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                                <a href="{{ route('login', ['redirect_to' => request()->getRequestUri()]) }}"
                                   class="inline-flex items-center justify-center rounded-full bg-pink-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600">
                                    Login Sekarang
                                </a>
                                <a href="{{ route('register', ['redirect_to' => request()->getRequestUri()]) }}"
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
