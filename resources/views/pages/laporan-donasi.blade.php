<x-layouts.front-end-layout>
    <div class="bg-[radial-gradient(circle_at_top_left,_rgba(251,113,133,0.18),_transparent_28%),linear-gradient(180deg,_#fff7f9_0%,_#ffffff_72%)]">
        <section class="relative overflow-hidden">
            <div class="absolute inset-x-0 top-0 h-64 bg-gradient-to-b from-pink-100/50 to-transparent"></div>

            <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-3xl text-center">
                    <h1 class="mt-6 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl lg:text-5xl">
                        Laporan donasi
                        <span class="text-pink-500">lengkap dan rapi</span>
                    </h1>
                    <p class="mt-5 text-base leading-7 text-gray-600 sm:text-lg">
                        Di halaman ini kamu bisa melihat ringkasan saldo dana bersama, daftar pengeluaran per bulan, dan bukti penggunaan dana
                    </p>
                </div>

                <div class="mx-auto mt-10 max-w-4xl rounded-[1.75rem] border border-pink-100 bg-white/90 p-5 shadow-xl shadow-pink-100/60 backdrop-blur sm:p-6">
                    <div class="grid gap-4 md:grid-cols-3">
                        <article class="rounded-3xl border border-emerald-100 bg-emerald-50 p-5">
                            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Total Donasi Masuk</p>
                            <p class="mt-3 text-2xl font-extrabold text-emerald-950">Rp{{ number_format($totalMasuk, 0, ',', '.') }}</p>
                            <p class="mt-2 text-sm leading-6 text-emerald-800">Seluruh donasi yang sudah tercatat.</p>
                        </article>

                        <article class="rounded-3xl border border-rose-100 bg-rose-50 p-5">
                            <p class="text-xs font-semibold uppercase tracking-wide text-rose-700">Total Dana Terpakai</p>
                            <p class="mt-3 text-2xl font-extrabold text-rose-950">Rp{{ number_format($totalKeluar, 0, ',', '.') }}</p>
                            <p class="mt-2 text-sm leading-6 text-rose-800">Seluruh pengeluaran yang sudah dicatat admin.</p>
                        </article>

                        <article class="rounded-3xl border border-sky-100 bg-sky-50 p-5">
                            <p class="text-xs font-semibold uppercase tracking-wide text-sky-700">Sisa Saldo</p>
                            <p class="mt-3 text-2xl font-extrabold text-sky-950">Rp{{ number_format($saldo, 0, ',', '.') }}</p>
                            <p class="mt-2 text-sm leading-6 text-sky-800">Sisa dana bersama yang masih tersedia.</p>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-transparent pb-16">
            <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 sm:pt-8 lg:px-8 lg:pt-10">
                <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div class="max-w-3xl">
                        <p class="text-sm font-semibold text-pink-500">Rangkuman publik</p>
                        <h2 class="mt-1 text-2xl font-extrabold text-gray-900">Semua ringkasan dan tabel laporan donasi</h2>
                    </div>

                    <a
                        href="{{ route('donasi.public') }}"
                        class="inline-flex items-center justify-center rounded-full border-2 border-pink-500 px-6 py-3 text-sm font-semibold text-pink-500 transition hover:bg-pink-50"
                    >
                        Kembali ke donasi
                    </a>
                </div>

                @include('partials.transparency-report', [
                    'totalMasuk' => $totalMasuk,
                    'totalKeluar' => $totalKeluar,
                    'saldo' => $saldo,
                    'rincianPenggunaanPerBulan' => $rincianPenggunaanPerBulan,
                    'showSummary' => false,
                ])
            </div>
        </section>
    </div>
</x-layouts.front-end-layout>
