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
                            ['title' => 'Pakan', 'emoji' => '&#x1F37D;&#xFE0F;'],
                            ['title' => 'Sterilisasi', 'emoji' => '&#x2702;&#xFE0F;'],
                            ['title' => 'Pengobatan', 'emoji' => '&#x1F48A;'],
                            ['title' => 'Vaksinasi', 'emoji' => '&#x1F489;'],
                            ['title' => 'Rescue', 'emoji' => '&#x1F691;'],
                            ['title' => 'Lainnya', 'emoji' => '&#x1F43E;'],
                        ];
                    @endphp

                    @foreach($programDonasi as $item)
                        <div class="flex flex-col items-center text-center">
                            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full border border-gray-300 bg-white text-2xl shadow-sm">
                                {!! $item['emoji'] !!}
                            </div>
                            <p class="mt-2 text-xs font-semibold text-gray-800 sm:text-sm">{{ $item['title'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <style>
                .donasi-photo-button {
                    appearance: none;
                    border: 0;
                    padding: 0;
                    background: transparent;
                    cursor: zoom-in;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                }

                .donasi-photo-thumb {
                    width: 3.25rem;
                    height: 3.25rem;
                    border-radius: 0.875rem;
                    object-fit: cover;
                    border: 1px solid #e5e7eb;
                    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
                }

                .donasi-photo-modal {
                    position: fixed;
                    inset: 0;
                    display: none;
                    align-items: center;
                    justify-content: center;
                    padding: 1rem;
                    background: rgba(15, 23, 42, 0.78);
                    z-index: 9999;
                }

                .donasi-photo-modal.is-open {
                    display: flex;
                }

                .donasi-photo-modal-panel {
                    width: min(92vw, 56rem);
                    border-radius: 1.5rem;
                    background: #fff;
                    overflow: hidden;
                    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
                }

                .donasi-photo-modal-header {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 1rem;
                    padding: 1rem 1.25rem;
                    border-bottom: 1px solid #e5e7eb;
                }

                .donasi-photo-modal-title {
                    margin: 0;
                    font-size: 1rem;
                    font-weight: 700;
                    color: #111827;
                }

                .donasi-photo-modal-close {
                    border: 0;
                    background: #f3f4f6;
                    color: #111827;
                    width: 2.25rem;
                    height: 2.25rem;
                    border-radius: 9999px;
                    cursor: pointer;
                    font-size: 1.25rem;
                    line-height: 1;
                }

                .donasi-photo-modal-image {
                    width: 100%;
                    max-height: 80vh;
                    object-fit: contain;
                    background: #f8fafc;
                }
            </style>

            <div class="mx-auto mt-12 max-w-6xl rounded-[2rem] border border-pink-100 bg-white/95 p-6 shadow-xl shadow-pink-100/40 sm:p-8">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-3xl">
                        <p class="text-sm font-semibold text-pink-500">Contoh penggunaan donasi</p>
                        <h2 class="mt-1 text-2xl font-extrabold text-gray-900">Lihat contoh penggunaan & laporan penggunaan dana</h2>
                    </div>

                    <a
                        href="{{ route('laporan-donasi.public') }}"
                        class="inline-flex items-center justify-center rounded-full bg-pink-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600"
                    >
                        Lihat laporan donasi lengkap
                    </a>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @forelse($contohPenggunaanDonasi as $item)
                        <article class="overflow-hidden rounded-[1.5rem] border border-gray-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
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
                                    <div class="flex h-full items-center justify-center text-6xl text-pink-300">&#x1F5BC;&#xFE0F;</div>
                                @endif
                            </div>

                            <div class="p-4 sm:p-5">
                                <div class="flex items-start justify-between gap-3">
                                    <span class="inline-flex rounded-full bg-pink-100 px-3 py-1 text-xs font-semibold text-pink-700">
                                        {{ $item['kategori'] }}
                                    </span>
                                    <span class="text-xs font-bold text-gray-400 sm:text-sm">{{ $item['nominal'] }}</span>
                                </div>

                                <h3 class="mt-3 text-lg font-extrabold leading-6 text-gray-900 sm:mt-4 sm:text-xl sm:leading-7">
                                    {{ $item['judul'] }}
                                </h3>

                                <div class="mt-3 rounded-2xl bg-gray-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Hasil penggunaan</p>
                                    <p class="mt-1 text-sm leading-6 text-gray-700">{{ $item['hasil'] }}</p>
                                </div>

                                <div class="mt-3 flex flex-wrap gap-2 text-[11px] text-gray-400 sm:mt-4">
                                    @if(!empty($item['tanggal']))
                                        <span class="inline-flex items-center gap-1 rounded-full bg-white px-3 py-1 shadow-sm">Dipakai {{ $item['tanggal'] }}</span>
                                    @endif
                                    @if(!empty($item['status']))
                                        <span class="inline-flex items-center gap-1 rounded-full bg-pink-50 px-3 py-1 font-semibold text-pink-600">{{ $item['status'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-[1.5rem] border border-dashed border-pink-200 bg-pink-50/50 p-6 text-center md:col-span-2 xl:col-span-3">
                            <p class="text-sm font-semibold text-gray-800">Belum ada contoh penggunaan donasi untuk ditampilkan.</p>
                            <p class="mt-1 text-sm text-gray-500">Nanti kartu penggunaan dana akan muncul di sini setelah admin menambahkan data publik.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="donasi-photo-modal" id="donasiPhotoModal" aria-hidden="true">
                <div class="donasi-photo-modal-panel" role="dialog" aria-modal="true" aria-labelledby="donasiPhotoModalTitle">
                    <div class="donasi-photo-modal-header">
                        <div>
                            <h3 class="donasi-photo-modal-title" id="donasiPhotoModalTitle">Pratinjau Foto Bukti</h3>
                            <p class="mt-1 text-sm text-gray-500">Klik di luar gambar atau tombol tutup untuk menutup.</p>
                        </div>
                        <button type="button" class="donasi-photo-modal-close" data-donasi-photo-close aria-label="Tutup">&times;</button>
                    </div>
                    <img src="" alt="Foto bukti penggunaan dana" class="donasi-photo-modal-image" id="donasiPhotoModalImage">
                </div>
            </div>

            <script>
                (function () {
                    const modal = document.getElementById('donasiPhotoModal');
                    const modalImage = document.getElementById('donasiPhotoModalImage');
                    const modalTitle = document.getElementById('donasiPhotoModalTitle');

                    function openModal(src, title) {
                        if (!src) {
                            return;
                        }

                        modalImage.src = src;
                        modalTitle.textContent = title || 'Pratinjau Foto Bukti';
                        modal.classList.add('is-open');
                        modal.setAttribute('aria-hidden', 'false');
                    }

                    function closeModal() {
                        modal.classList.remove('is-open');
                        modal.setAttribute('aria-hidden', 'true');
                        modalImage.src = '';
                    }

                    document.addEventListener('click', function (event) {
                        const trigger = event.target.closest('[data-donasi-photo-trigger]');

                        if (trigger) {
                            openModal(trigger.dataset.donasiPhotoSrc, trigger.dataset.donasiPhotoTitle);
                            return;
                        }

                        if (event.target.matches('[data-donasi-photo-close]') || event.target === modal) {
                            closeModal();
                        }
                    });

                    document.addEventListener('keydown', function (event) {
                        if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                            closeModal();
                        }
                    });
                })();
            </script>
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
