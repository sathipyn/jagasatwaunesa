<x-layouts.front-end-layout>
    @php
        $images = collect($edukasi->cover_image ?? [])->filter()->values();
        $heroImage = $images->first();
        $supportingImages = $images->slice(1)->values();
        $closingImages = collect($edukasi->closing_image ?? [])->filter()->values();
    @endphp
    <section class="bg-[linear-gradient(180deg,_#fff7f9_0%,_#ffffff_70%)] py-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <a href="{{ route('edukasi') }}" class="inline-flex items-center text-sm font-semibold text-pink-600 hover:text-pink-700">
                Kembali ke edukasi
            </a>

            <div class="mt-6">
                <article class="overflow-hidden rounded-[2rem] border border-gray-100 bg-white shadow-sm">
                    <div class="flex items-center justify-center pt-5 sm:pt-6">
                        @if($heroImage)
                            <img
                                src="{{ route('media.public', ['path' => $heroImage]) }}"
                                alt="{{ $edukasi->judul }}"
                                loading="lazy"
                                decoding="async"
                                class="max-h-[26rem] w-full object-contain object-center bg-white"
                            >
                        @else
                            <div class="flex min-h-[18rem] w-full items-center justify-center text-5xl font-bold text-gray-300">
                                Edukasi
                            </div>
                        @endif
                    </div>

                    <div class="p-6 sm:p-8">
                    <div class="flex flex-wrap gap-2">
                        <span class="rounded-full bg-pink-50 px-3 py-1.5 text-xs font-semibold text-pink-600">{{ $edukasi->kategori ?: 'Edukasi' }}</span>
                        @if($edukasi->is_featured)
                            <span class="rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700">Unggulan</span>
                        @endif
                        @if($edukasi->published_at)
                            <span class="rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-600">{{ $edukasi->published_at->format('d M Y') }}</span>
                        @endif
                        <span class="rounded-full bg-pink-100 px-3 py-1.5 text-xs font-semibold text-pink-600">{{ $edukasi->komentar_postingan_count }} komentar</span>
                    </div>

                    <h1 class="mt-5 text-3xl font-extrabold leading-tight text-gray-900 sm:text-4xl">
                        {{ $edukasi->judul }}
                    </h1>

                        @if($edukasi->ringkasan)
                            <p class="mt-3 text-base font-semibold leading-7 text-gray-700">
                                {{ $edukasi->ringkasan }}
                            </p>
                        @endif

                        <div class="mt-4 whitespace-pre-line text-sm leading-7 text-gray-600">
                            {{ $edukasi->konten ?: 'Isi artikel belum ditambahkan oleh admin.' }}
                        </div>

                        @if($supportingImages->isNotEmpty())
                            <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach($supportingImages as $image)
                                    <img
                                        src="{{ route('media.public', ['path' => $image]) }}"
                                        alt="{{ $edukasi->judul }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="h-40 w-full rounded-2xl object-cover object-center bg-white"
                                    >
                                @endforeach
                            </div>
                        @endif

                        @if($edukasi->konten_tambahan)
                            <div class="mt-6 whitespace-pre-line text-sm leading-7 text-gray-600">
                                {{ $edukasi->konten_tambahan }}
                            </div>
                        @endif

                        @if($closingImages->isNotEmpty())
                            <div class="mt-8 space-y-4">
                                @foreach($closingImages as $image)
                                    <img
                                        src="{{ route('media.public', ['path' => $image]) }}"
                                        alt="{{ $edukasi->judul }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="max-h-[28rem] w-full rounded-[1.5rem] object-cover object-center bg-white"
                                    >
                                @endforeach
                            </div>
                        @endif
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-white pb-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <livewire:postingan-komentar :edukasi="$edukasi" />
        </div>
    </section>
</x-layouts.front-end-layout>
