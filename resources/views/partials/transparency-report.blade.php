@php
    $rincianPenggunaanPerBulan = $rincianPenggunaanPerBulan ?? collect();
    $showSummary = $showSummary ?? true;
@endphp

<style>
    .transparency-photo-button {
        appearance: none;
        border: 0;
        padding: 0;
        background: transparent;
        cursor: zoom-in;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .transparency-photo-thumb {
        width: 3.25rem;
        height: 3.25rem;
        border-radius: 0.875rem;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
    }

    .transparency-photo-modal {
        position: fixed;
        inset: 0;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        background: rgba(15, 23, 42, 0.78);
        z-index: 9999;
    }

    .transparency-photo-modal.is-open {
        display: flex;
    }

    .transparency-photo-modal-panel {
        width: min(92vw, 56rem);
        border-radius: 1.5rem;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
    }

    .transparency-photo-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .transparency-photo-modal-title {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
    }

    .transparency-photo-modal-close {
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

    .transparency-photo-modal-image {
        width: 100%;
        max-height: 80vh;
        object-fit: contain;
        background: #f8fafc;
    }
</style>

<div class="space-y-8">
    @if($showSummary)
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
    @endif

    <div class="rounded-[2rem] border border-gray-200 bg-white p-5 shadow-xl shadow-gray-100 sm:p-6">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-pink-500">Transparansi Dana</p>
                <h2 class="mt-1 text-2xl font-extrabold text-gray-900">Rincian Pengeluaran</h2>
                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Setiap transaksi pengeluaran dikelompokkan per bulan supaya lebih mudah dibaca.
                </p>
            </div>
        </div>

        <div class="mt-6 space-y-4">
            @forelse($rincianPenggunaanPerBulan as $bulan)
                <article class="rounded-[1.5rem] border border-gray-200 bg-gray-50 p-4 sm:p-5">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <h3 class="text-lg font-extrabold text-gray-900">{{ $bulan['label'] }}</h3>
                        </div>
                        <span class="inline-flex self-start rounded-full bg-white px-3 py-1 text-xs font-semibold text-gray-500 shadow-sm">
                            Subtotal Rp{{ number_format($bulan['total'], 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="mt-4 overflow-hidden rounded-2xl border border-gray-200 bg-white">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tanggal</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Foto</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Kategori</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Jumlah</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach($bulan['items'] as $pengeluaran)
                                        <tr class="align-top">
                                            <td class="px-4 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-700">
                                                {{ $pengeluaran->tanggal?->format('d M Y') }}
                                            </td>
                                            <td class="px-4 py-4">
                                                @if($foto = $pengeluaran->fotoUtama())
                                                    <button
                                                        type="button"
                                                        class="transparency-photo-button"
                                                        data-transparency-photo-trigger
                                                        data-transparency-photo-src="{{ route('media.public', ['path' => $foto]) }}"
                                                        data-transparency-photo-title="{{ \App\Models\PenggunaanDana::kategoriLabel($pengeluaran->kategori) }} - {{ $pengeluaran->tanggal?->format('d M Y') }}"
                                                    >
                                                        <img
                                                            src="{{ route('media.public', ['path' => $foto]) }}"
                                                            alt="Foto bukti {{ \App\Models\PenggunaanDana::kategoriLabel($pengeluaran->kategori) }}"
                                                            class="transparency-photo-thumb"
                                                        >
                                                    </button>
                                                @else
                                                    <span class="text-sm text-gray-400">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4">
                                                <span class="inline-flex rounded-full bg-pink-100 px-3 py-1 text-xs font-semibold text-pink-700">
                                                    {{ \App\Models\PenggunaanDana::kategoriLabel($pengeluaran->kategori) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-4 text-sm font-semibold text-gray-900">
                                                Rp{{ number_format($pengeluaran->jumlah, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-4 text-sm leading-6 text-gray-600">
                                                {{ $pengeluaran->keterangan ?: '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-[1.5rem] border border-dashed border-gray-200 bg-gray-50 px-6 py-10 text-center text-sm text-gray-500">
                    Belum ada pengeluaran yang ditampilkan.
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="transparency-photo-modal" id="transparencyPhotoModal" aria-hidden="true">
    <div class="transparency-photo-modal-panel" role="dialog" aria-modal="true" aria-labelledby="transparencyPhotoModalTitle">
        <div class="transparency-photo-modal-header">
            <div>
                <h3 class="transparency-photo-modal-title" id="transparencyPhotoModalTitle">Pratinjau Foto Bukti</h3>
                <p class="mt-1 text-sm text-gray-500">Klik di luar gambar atau tombol tutup untuk menutup.</p>
            </div>
            <button type="button" class="transparency-photo-modal-close" data-transparency-photo-close aria-label="Tutup">&times;</button>
        </div>
        <img src="" alt="Foto bukti penggunaan dana" class="transparency-photo-modal-image" id="transparencyPhotoModalImage">
    </div>
</div>

<script>
    (function () {
        const modal = document.getElementById('transparencyPhotoModal');
        const modalImage = document.getElementById('transparencyPhotoModalImage');
        const modalTitle = document.getElementById('transparencyPhotoModalTitle');

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
            const trigger = event.target.closest('[data-transparency-photo-trigger]');

            if (trigger) {
                openModal(trigger.dataset.transparencyPhotoSrc, trigger.dataset.transparencyPhotoTitle);
                return;
            }

            if (event.target.matches('[data-transparency-photo-close]') || event.target === modal) {
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
