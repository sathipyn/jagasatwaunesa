<div class="grid gap-8 lg:grid-cols-[1.05fr,0.95fr]">
    <section class="rounded-[2rem] border border-pink-100 bg-white p-6 shadow-xl shadow-pink-100/50 sm:p-8">
        @if($showSuccess)
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-gradient-to-r from-emerald-50 to-teal-50 p-5">
                <p class="text-sm font-semibold text-emerald-800">Pengajuan adopsi berhasil dikirim.</p>
                <p class="mt-1 text-sm text-emerald-700">Tim JagaSatwa akan meninjau pengajuanmu dan menghubungi kamu lewat WhatsApp.</p>
            </div>
        @endif

        <div class="mb-6 border-b border-gray-100 pb-6">
            <p class="flex items-center gap-2 text-sm font-semibold text-pink-500">
                Form adopsi aktif
            </p>
            <h3 class="mt-1 text-2xl font-extrabold text-gray-900">Ajukan adopsi kucing kampus</h3>
            <p class="mt-2 text-sm leading-6 text-gray-500">
                Isi data dengan lengkap supaya tim lebih mudah menilai kesiapan adopsimu.
            </p>
        </div>

        <form wire:submit="submit" class="space-y-5">
            <div class="grid gap-5 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Kucing yang diajukan <span class="text-red-500">*</span></label>
                    <select wire:model="kucing_id" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200">
                        <option value="">Pilih kucing open adopsi</option>
                        @foreach($kucingTersedia as $kucing)
                            <option value="{{ $kucing->id }}">{{ $kucing->nama_kucing ?: 'Tanpa nama' }} - {{ $kucing->lokasi_kucing ?: 'Lokasi belum dicatat' }}</option>
                        @endforeach
                    </select>
                    @error('kucing_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Nama lengkap <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="nama_lengkap" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200" placeholder="Nama lengkap kamu">
                    @error('nama_lengkap') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Nomor WhatsApp <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="no_hp" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200" placeholder="08xxxxxxxxxx">
                    @error('no_hp') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                    <select wire:model="status" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200">
                        <option value="">Pilih status</option>
                        <option value="Bekerja">Bekerja</option>
                        <option value="Kuliah">Kuliah</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    @error('status') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Domisili <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="domisili" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200" placeholder="Contoh: Surabaya">
                    @error('domisili') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Penghasilan per bulan <span class="text-red-500">*</span></label>
                    <div class="flex items-center rounded-2xl border border-gray-200 px-4 focus-within:border-pink-300 focus-within:ring-2 focus-within:ring-pink-200">
                        <span class="text-sm font-semibold text-pink-500">Rp</span>
                        <input type="number" min="0" wire:model="penghasilan" class="w-full border-0 bg-transparent px-3 py-3 outline-none focus:ring-0" placeholder="1500000">
                    </div>
                    @error('penghasilan') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Pro dokter hewan? <span class="text-red-500">*</span></label>
                    <select wire:model="pro_dokter_hewan" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200">
                        <option value="">Pilih jawaban</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                        <option value="Mungkin">Mungkin</option>
                    </select>
                    @error('pro_dokter_hewan') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Siap update kabar? <span class="text-red-500">*</span></label>
                    <select wire:model="update_kabar" class="w-full rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200">
                        <option value="">Pilih jawaban</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                    @error('update_kabar') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Alasan mengadopsi <span class="text-red-500">*</span></label>
                    <textarea wire:model="alasan" rows="5" class="w-full resize-none rounded-2xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200" placeholder="Ceritakan alasan, kesiapan, dan bagaimana kamu akan merawat kucing ini."></textarea>
                    @error('alasan') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div wire:loading wire:target="submit" class="text-sm text-pink-500">
                Mengirim pengajuan adopsi...
            </div>

            <div class="flex flex-col gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-xs leading-5 text-gray-400">
                    Pengajuan ini akan masuk ke tim JagaSatwa untuk ditinjau lebih lanjut.
                </p>

                <button type="submit" wire:loading.attr="disabled" class="inline-flex items-center justify-center rounded-full bg-pink-500 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600 disabled:opacity-50">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </section>

    <aside class="space-y-6">
        <div class="rounded-[1.75rem] border border-pink-100 bg-white p-6 shadow-sm shadow-pink-100/50">
            <div class="flex items-center justify-between gap-3">
                <div>
                <p class="flex items-center gap-2 text-sm font-semibold text-pink-500">
                Riwayat pengajuan adopsi
            </p>
                        <h3 class="mt-1 text-2xl font-extrabold text-gray-900">Pantau status pengajuan yang sudah pernah kamu kirim</h3>        
                </div>
                <span class="rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold text-pink-600">
                    {{ count($riwayat) }} pengajuan
                </span>
            </div>

            @if(count($riwayat) > 0)
                <div class="mt-5 space-y-4">
                    @foreach($riwayat as $adopsi)
                        <div class="rounded-2xl border border-gray-100 bg-gradient-to-r from-white to-pink-50/40 p-4">
                            <div class="flex items-start gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-pink-500 text-sm font-bold text-white shadow-sm">
                                    {{ $loop->iteration }}
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <p class="text-sm font-bold text-gray-900">{{ $adopsi->kucing->nama_kucing ?? 'Kucing' }}</p>
                                        <span class="rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $adopsi->status_adopsi === 'Diterima' ? 'bg-emerald-100 text-emerald-700' : ($adopsi->status_adopsi === 'Ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                                            {{ $adopsi->status_adopsi }}
                                        </span>
                                    </div>
                                    <p class="mt-2 text-[11px] text-gray-400">{{ $adopsi->tanggal_pengajuan?->format('d M Y') }}</p>
                                    <p class="mt-2 text-xs leading-5 text-gray-500">{{ \Illuminate\Support\Str::limit($adopsi->alasan, 90) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mt-5 rounded-2xl border border-dashed border-pink-200 bg-pink-50/60 p-5 text-center">
                    <p class="text-sm font-semibold text-gray-700">Belum ada pengajuan adopsi.</p>
                    <p class="mt-1 text-xs text-gray-500">Pengajuan pertamamu akan tampil di sini.</p>
                </div>
            @endif
        </div>
    </aside>
</div>
