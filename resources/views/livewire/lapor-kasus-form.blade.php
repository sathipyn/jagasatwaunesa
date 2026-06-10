<div class="grid gap-8 min-[520px]:grid-cols-[1.15fr,0.85fr]">
    <section class="rounded-[2rem] border border-pink-100 bg-white p-6 shadow-xl shadow-pink-100/60 sm:p-8">
        @if($showSuccess)
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-gradient-to-r from-emerald-50 to-teal-50 p-5">
                <p class="flex items-center gap-2 text-sm font-semibold text-emerald-800">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100">✨</span>
                    Laporan berhasil dikirim.
                </p>
                <p class="mt-1 text-sm text-emerald-700">Terima kasih, tim JagaSatwa akan meninjau laporanmu sesegera mungkin.</p>
            </div>
        @endif

        <div class="mb-6 flex flex-col gap-3 border-b border-gray-100 pb-6 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="flex items-center gap-2 text-sm font-semibold text-pink-500">
                    Form laporan
                </p>
                <h3 class="mt-1 text-2xl font-extrabold text-gray-900">Ceritakan kasus yang kamu temukan</h3>
            </div>
        </div>

        <form wire:submit="submit" class="space-y-3">
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Judul laporan <span class="text-red-500">*</span></label>
                <input
                    type="text"
                    wire:model="judul_laporan"
                    class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200"
                    placeholder="Contoh: Kucing sakit ditemukan di area Foodcourt"
                >
                @error('judul_laporan') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Kategori kasus <span class="text-red-500">*</span></label>
                <select
                    wire:model="kategori_kasus"
                    class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200"
                >
                    <option value="">Pilih kategori kasus</option>
                    @foreach($kategoriKasus as $value => $item)
                        <option value="{{ $value }}">{{ $item['label'] }}</option>
                    @endforeach
                </select>
                <p class="mt-2 text-xs text-gray-500">Pilih kategori yang paling sesuai agar laporan lebih mudah dipetakan dan ditindaklanjuti.</p>
                @error('kategori_kasus') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Deskripsi kasus <span class="text-red-500">*</span></label>
                    <textarea
                        wire:model="deskripsi_kasus"
                        rows="5"
                        class="w-full resize-none rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200"
                        placeholder="Jelaskan kondisi kucing, situasi di lokasi, dan apakah ada tindakan yang sudah dilakukan."
                    ></textarea>
                    @error('deskripsi_kasus') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Lokasi kejadian</label>
                    <input
                        type="text"
                        wire:model="lokasi_laporan"
                        class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200"
                        placeholder="Contoh: Depan Gedung A1 FISIPOL"
                    >
                    @error('lokasi_laporan') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Upload bukti pendukung</label>
                    <div class="rounded-2xl border border-dashed border-pink-200 bg-gradient-to-r from-pink-50 to-rose-50 p-4">
                        <input
                            type="file"
                            wire:model="bukti_pendukung"
                            multiple
                            accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-white file:px-4 file:py-2 file:text-sm file:font-semibold file:text-pink-600 hover:file:bg-pink-100"
                        >
                        <p class="mt-2 text-xs text-gray-400">JPG / PNG, maksimal 2MB per file.</p>
                    </div>
                    @error('bukti_pendukung.*') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            @if($bukti_pendukung)
                <div>
                    <p class="mb-3 flex items-center gap-2 text-sm font-medium text-gray-700">
                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-sky-100">🖼️</span>
                        Preview bukti
                    </p>
                    <div class="flex flex-wrap gap-3">
                        @foreach($bukti_pendukung as $foto)
                            <img src="{{ $foto->temporaryUrl() }}" class="h-24 w-24 rounded-2xl border border-pink-100 object-cover shadow-sm">
                        @endforeach
                    </div>
                </div>
            @endif

            <div wire:loading wire:target="submit" class="flex items-center gap-2 text-sm text-pink-500">
                <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                Mengirim laporan...
            </div>

            <div class="flex flex-col gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-xs leading-5 text-gray-400">
                    Dengan mengirim laporan ini, kamu membantu tim kami memetakan kasus yang perlu ditindaklanjuti lebih cepat.
                </p>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center rounded-full bg-pink-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600 disabled:opacity-50"
                >
                    Kirim Laporan
                </button>
            </div>
        </form>
    </section>

    <aside class="space-y-6">
        <div class="rounded-[1.75rem] border border-pink-100 bg-white p-6 shadow-sm shadow-pink-100/50">
            <div class="flex items-center justify-between gap-3">
                <div>
                <p class="flex items-center gap-2 text-sm font-semibold text-pink-500">
                    Riwayat laporan kamu
                </p>
                    <h3 class="mt-1 text-2xl font-extrabold text-gray-900">Pantau status laporan terbaru</h3>
                </div>
                <span class="rounded-full bg-gradient-to-r from-pink-50 to-rose-50 px-3 py-1 text-xs font-semibold text-pink-600">
                    {{ count($riwayat) }} laporan
                </span>
            </div>

            @if(count($riwayat) > 0)
                <div class="mt-5 space-y-4">
                    @foreach($riwayat as $laporan)
                        <div class="rounded-2xl border border-gray-100 bg-gradient-to-r from-white to-pink-50/40 p-4 transition hover:shadow-md">
                            <div class="flex items-start gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-pink-500 text-sm font-bold text-white shadow-sm">
                                    {{ $loop->iteration }}
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h4 class="truncate text-sm font-bold text-gray-900">{{ $laporan->judul_laporan }}</h4>
                                        <span class="rounded-full px-2.5 py-1 text-[11px] font-semibold bg-pink-100 text-pink-700">
                                            {{ \App\Models\LaporanKasus::kategoriKasusEmoji($laporan->kategori_kasus) }} {{ \App\Models\LaporanKasus::kategoriKasusLabel($laporan->kategori_kasus) }}
                                        </span>
                                        <span class="rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $laporan->status_laporan === 'Selesai' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                            {{ $laporan->status_laporan }}
                                        </span>
                                    </div>
                                    <p class="mt-2 text-xs leading-5 text-gray-500">{{ Str::limit($laporan->deskripsi_kasus, 96) }}</p>
                                    <div class="mt-3 flex flex-wrap gap-3 text-[11px] text-gray-400">
                                        <span class="inline-flex items-center gap-1"><span>🗓️</span>{{ $laporan->tanggal_laporan->format('d M Y') }}</span>
                                        @if($laporan->lokasi_laporan)
                                            <span class="inline-flex items-center gap-1"><span>📍</span>{{ $laporan->lokasi_laporan }}</span>
                                        @endif
                                    </div>

                                    @if($laporan->bukti_pendukung)
                                        <div class="mt-3 flex gap-2">
                                            @foreach(array_slice((array) $laporan->bukti_pendukung, 0, 2) as $foto)
                                                <img
                                                    src="{{ route('media.public', ['path' => $foto]) }}"
                                                    class="h-14 w-14 rounded-xl border border-pink-100 object-cover bg-white"
                                                    alt="Bukti laporan"
                                                >
                                            @endforeach
                                        </div>
                                    @endif

                                    @if($laporan->hasil_penanganan || $laporan->foto_penanganan)
                                        <div class="mt-4 rounded-2xl border border-emerald-100 bg-emerald-50/70 p-3">
                                            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Hasil penanganan</p>

                                            @if($laporan->tanggal_penanganan)
                                                <p class="mt-1 text-[11px] text-emerald-600">
                                                    {{ $laporan->tanggal_penanganan->format('d M Y') }}
                                                </p>
                                            @endif

                                            @if($laporan->hasil_penanganan)
                                                <p class="mt-2 text-xs leading-5 text-gray-600">
                                                    {{ $laporan->hasil_penanganan }}
                                                </p>
                                            @endif

                                            @if($laporan->foto_penanganan)
                                                <div class="mt-3 flex gap-2">
                                                    @foreach(array_slice((array) $laporan->foto_penanganan, 0, 2) as $fotoPenanganan)
                                                        <img
                                                            src="{{ route('media.public', ['path' => $fotoPenanganan]) }}"
                                                            class="h-14 w-14 rounded-xl border border-emerald-100 object-cover bg-white"
                                                            alt="Foto penanganan"
                                                        >
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mt-5 rounded-2xl border border-dashed border-pink-200 bg-pink-50/60 p-5 text-center">
                    <p class="text-sm font-semibold text-gray-700">Belum ada riwayat laporan.</p>
                    <p class="mt-1 text-xs text-gray-500">Laporan yang kamu kirim akan muncul di sini.</p>
                </div>
            @endif
        </div>
    </aside>
</div>
