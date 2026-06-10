<div class="grid gap-8 lg:grid-cols-[1.05fr,0.95fr]">
    <section class="rounded-[2rem] border border-pink-100 bg-white p-6 shadow-xl shadow-pink-100/50 sm:p-8">
        @if($showSuccess)
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-gradient-to-r from-emerald-50 to-teal-50 p-5">
                <p class="text-sm font-semibold text-emerald-800">Donasi berhasil dikirim.</p>
                <p class="mt-1 text-sm text-emerald-700">Terima kasih, bukti transfermu sudah kami simpan. Semoga segala hal-hal baik kembali kepada kamu ya</p>
            </div>
        @endif

        <div class="mb-6 border-b border-gray-100 pb-6">
            <p class="flex items-center gap-2 text-sm font-semibold text-pink-500">
                Form donasi
            </p>
            <h3 class="mt-1 text-2xl font-extrabold text-gray-900">Konfirmasi donasi kamu di sini</h3>
            <p class="mt-2 text-sm leading-6 text-gray-500">
                Isi nominal, pilih tujuan donasi, lalu unggah bukti transfer supaya tim JagaSatwa bisa mencatatnya dengan rapi.
            </p>
        </div>

        <div class="mb-6 rounded-[1.75rem] border border-pink-100 bg-gradient-to-br from-pink-50 via-white to-rose-50 p-5">
            <label class="mb-3 block text-sm font-medium text-gray-700">Transfer ke mana <span class="text-red-500">* tolong pilih sesuai bukti transfer</span></label>

            @php
                $metodeTransfer = [
                    'bca' => ['label' => 'BCA', 'icon' => 'BC'],
                    'spay' => ['label' => 'SPay', 'icon' => 'SP'],
                ];
            @endphp

            <div class="grid gap-4 lg:grid-cols-[minmax(0,_1fr)_220px]">
                <div class="min-h-[12rem] rounded-2xl border border-white bg-white p-4 sm:min-h-[16rem]">
                    @if($metode_transfer === 'spay')
                        <div class="flex h-full flex-col items-center justify-center text-center">
                            <p class="text-sm font-bold text-gray-900">ShopeePay</p>
                            <div class="mt-1 flex items-center justify-center gap-1.5">
                                <p class="text-lg font-extrabold text-pink-500">085934362426</p>
                                <button
                                    type="button"
                                    onclick="navigator.clipboard.writeText('085934362426'); this.title = 'Tersalin'; setTimeout(() => this.title = 'Copy nomor', 1400);"
                                    class="inline-flex items-center justify-center text-pink-400 transition hover:text-pink-600"
                                    title="Copy nomor"
                                    aria-label="Copy nomor ShopeePay"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-3.5 w-3.5">
                                        <path d="M8.25 7.5A2.25 2.25 0 0 1 10.5 5.25h6A2.25 2.25 0 0 1 18.75 7.5v9A2.25 2.25 0 0 1 16.5 18.75h-6A2.25 2.25 0 0 1 8.25 16.5v-9Z" />
                                        <path d="M5.25 9A2.25 2.25 0 0 1 7.5 6.75V16.5A3.75 3.75 0 0 0 11.25 20.25h4.5A2.25 2.25 0 0 1 13.5 21.75h-6A2.25 2.25 0 0 1 5.25 19.5V9Z" />
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">a.n. Muhammad Nurul Ibad</p>
                        </div>
                    @elseif($metode_transfer === 'bca')
                        <div class="flex h-full flex-col items-center justify-center text-center">
                            <p class="text-sm font-bold text-gray-900">BCA</p>
                            <div class="mt-1 flex items-center justify-center gap-1.5">
                                <p class="text-lg font-extrabold text-pink-500">7205222197</p>
                                <button
                                    type="button"
                                    onclick="navigator.clipboard.writeText('7205222197'); this.title = 'Tersalin'; setTimeout(() => this.title = 'Copy no. rekening', 1400);"
                                    class="inline-flex items-center justify-center text-pink-400 transition hover:text-pink-600"
                                    title="Copy no. rekening"
                                    aria-label="Copy nomor rekening BCA"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-3.5 w-3.5">
                                        <path d="M8.25 7.5A2.25 2.25 0 0 1 10.5 5.25h6A2.25 2.25 0 0 1 18.75 7.5v9A2.25 2.25 0 0 1 16.5 18.75h-6A2.25 2.25 0 0 1 8.25 16.5v-9Z" />
                                        <path d="M5.25 9A2.25 2.25 0 0 1 7.5 6.75V16.5A3.75 3.75 0 0 0 11.25 20.25h4.5A2.25 2.25 0 0 1 13.5 21.75h-6A2.25 2.25 0 0 1 5.25 19.5V9Z" />
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">a.n. Muhammad Nurul Ibad</p>
                        </div>
                    @endif
                </div>

                <div class="grid h-full grid-cols-2 auto-rows-fr gap-2.5 lg:grid-cols-1">
                    @foreach($metodeTransfer as $value => $item)
                        <label class="cursor-pointer">
                            <input type="radio" wire:model.live="metode_transfer" value="{{ $value }}" class="sr-only">
                            <span class="flex h-full items-center gap-2 rounded-xl border px-3 py-2.5 transition {{ $metode_transfer === $value ? 'border-pink-300 bg-white shadow-sm shadow-pink-100' : 'border-transparent bg-white/80 hover:border-pink-200' }}">
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full {{ $metode_transfer === $value ? 'bg-pink-500 text-white' : 'bg-pink-100 text-pink-500' }} text-[10px] font-bold">
                                    {{ $item['icon'] }}
                                </span>
                                <span class="text-sm font-semibold text-gray-800">{{ $item['label'] }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
            @error('metode_transfer') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        <form wire:submit="submit" class="space-y-5">
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Jumlah donasi <span class="text-red-500">*</span></label>
                    <div class="flex items-center rounded-2xl border border-gray-200 px-4 focus-within:border-pink-300 focus-within:ring-2 focus-within:ring-pink-200">
                        <span class="text-sm font-semibold text-pink-500">Rp</span>
                        <input
                            type="number"
                            min="1000"
                            step="1000"
                            wire:model="jumlah_donasi"
                            class="w-full border-0 bg-transparent px-3 py-3 outline-none focus:ring-0"
                            placeholder="50000"
                        >
                    </div>
                    @error('jumlah_donasi') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Tanggal donasi <span class="text-red-500">*</span></label>
                    <input
                        type="date"
                        wire:model="tanggal_donasi"
                        class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200"
                    >
                    @error('tanggal_donasi') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Tujuan donasi <span class="text-red-500">*</span></label>
                    <select
                        wire:model="tujuan_donasi"
                        class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200"
                    >
                        <option value="">Pilih tujuan donasi</option>
                        <option value="Pakan">Pakan</option>
                        <option value="Steril">Sterilisasi</option>
                        <option value="Pengobatan">Pengobatan</option>
                        <option value="Vaksin">Vaksinasi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    @error('tujuan_donasi') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Catatan tambahan</label>
                    <textarea
                        wire:model="deskripsi"
                        rows="4"
                        class="w-full resize-none rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200"
                        placeholder="Contoh: donasi untuk kebutuhan obat pasca rescue minggu ini."
                    ></textarea>
                    @error('deskripsi') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Upload bukti transfer <span class="text-red-500">*</span></label>
                    <div class="rounded-2xl border border-dashed border-pink-200 bg-gradient-to-r from-pink-50 to-rose-50 p-4">
                        <input
                            type="file"
                            wire:model="bukti_transfer"
                            accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-white file:px-4 file:py-2 file:text-sm file:font-semibold file:text-pink-600 hover:file:bg-pink-100"
                        >
                        <p class="mt-2 text-xs text-gray-400">JPG / PNG, maksimal 2MB.</p>
                    </div>
                    @error('bukti_transfer') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            @if($bukti_transfer)
                <div>
                    <p class="mb-3 text-sm font-medium text-gray-700">Preview bukti transfer</p>
                    <img src="{{ $bukti_transfer->temporaryUrl() }}" class="h-36 w-full max-w-xs rounded-2xl border border-pink-100 object-cover shadow-sm">
                </div>
            @endif

            <div wire:loading wire:target="submit" class="text-sm text-pink-500">
                Mengirim data donasi...
            </div>

            <div class="flex flex-col gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-xs leading-5 text-gray-400">Donasi yang kamu kirim akan tersimpan di riwayat akunmu, kami akan mengirimkan bukti penggunaan donasi
                    
                </p>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center rounded-full bg-pink-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600 disabled:opacity-50"
                >
                    Kirim Donasi
                </button>
            </div>
        </form>
    </section>

    <aside class="space-y-6">
        <div class="rounded-[1.75rem] border border-pink-100 bg-white p-6 shadow-sm shadow-pink-100/50">
            <div class="flex items-center justify-between gap-3">
                <div>
<p class="flex items-center gap-2 text-sm font-semibold text-pink-500">
                        Riwayat donasi kamu
                    </p>
                     <h3 class="mt-1 text-2xl font-extrabold text-gray-900">Semua donasi yang kamu kirim akan tercatat di sini.</h3>
                </div>
                <span class="rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold text-pink-600">
                    {{ count($riwayat) }} donasi
                </span>
            </div>

            @if(count($riwayat) > 0)
                <div class="mt-5 space-y-4">
                    @foreach($riwayat as $donasi)
                        <div class="rounded-2xl border border-gray-100 bg-gradient-to-r from-white to-pink-50/40 p-4 transition hover:shadow-md">
                            <div class="flex items-start gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-pink-500 text-sm font-bold text-white shadow-sm">
                                    {{ $loop->iteration }}
                                </div>

                                <img
                                    src="{{ route('media.public', ['path' => $donasi->bukti_transfer]) }}"
                                    class="h-16 w-16 rounded-2xl border border-pink-100 object-cover bg-white"
                                    alt="Bukti transfer"
                                >

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <p class="text-sm font-bold text-gray-900">Rp{{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}</p>
                                        <span class="rounded-full bg-pink-100 px-2.5 py-1 text-[11px] font-semibold text-pink-600">
                                            {{ $donasi->tujuan_donasi }}
                                        </span>
                                        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-[11px] font-semibold text-gray-600">
                                            {{ $donasi->metode_transfer === 'spay' ? 'ShopeePay' : strtoupper((string) $donasi->metode_transfer) }}
                                        </span>
                                    </div>
                                    <p class="mt-2 text-[11px] text-gray-400">{{ $donasi->tanggal_donasi->format('d M Y') }}</p>

                                    @if($donasi->deskripsi)
                                        <p class="mt-2 text-xs leading-5 text-gray-500">{{ $donasi->deskripsi }}</p>
                                    @endif

                                    @if($donasi->hasil_penggunaan || $donasi->foto_penggunaan)
                                        <div class="mt-4 rounded-2xl border border-emerald-100 bg-emerald-50/70 p-3">
                                            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Penggunaan donasi</p>

                                            @if($donasi->tanggal_penggunaan)
                                                <p class="mt-1 text-[11px] text-emerald-600">
                                                    Dipakai {{ $donasi->tanggal_penggunaan->format('d M Y') }}
                                                </p>
                                            @endif

                                            @if($donasi->hasil_penggunaan)
                                                <p class="mt-2 text-xs leading-5 text-gray-600">
                                                    {{ $donasi->hasil_penggunaan }}
                                                </p>
                                            @endif

                                            @if($donasi->foto_penggunaan)
                                                <div class="mt-3 flex gap-2">
                                                    @foreach(array_slice((array) $donasi->foto_penggunaan, 0, 2) as $fotoPenggunaan)
                                                        <img
                                                            src="{{ route('media.public', ['path' => $fotoPenggunaan]) }}"
                                                            class="h-14 w-14 rounded-xl border border-emerald-100 object-cover bg-white"
                                                            alt="Bukti penggunaan donasi"
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
                    <p class="text-sm font-semibold text-gray-700">Belum ada riwayat donasi.</p>
                    <p class="mt-1 text-xs text-gray-500">Donasi pertamamu akan tampil di sini.</p>
                </div>
            @endif
        </div>
    </aside>
</div>
