<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'JAGASATWA UNESA' }}</title>
    <link rel="icon" href="{{ asset('images/logojagasatwa.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logojagasatwa.png') }}">
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.9.10/dist/dotlottie-wc.js" type="module"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased">

    {{-- ==================== NAVBAR ==================== --}}
    <nav x-data="{ mobileOpen: false }" class="sticky top-0 z-50 border-b border-gray-100 bg-white/95 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logojagasatwa.png') }}" alt="Logo JagaSatwa" class="h-10 w-10 rounded-full object-cover sm:h-14 sm:w-14">
                    <div class="lg:hidden">
                        <p class="text-sm font-extrabold tracking-tight text-gray-900">JagaSatwa</p>
                        <p class="text-[11px] font-medium text-gray-400">UNESA</p>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                              {{ request()->routeIs('home') ? 'bg-pink-50 text-pink-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        Beranda
                    </a>
                    <a href="{{ route('edukasi') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                              {{ request()->routeIs('edukasi') ? 'bg-pink-50 text-pink-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        Edukasi & Komunitas
                    </a>
                    <a href="{{ route('donasi.public') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                              {{ request()->routeIs('donasi.public') ? 'bg-pink-50 text-pink-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        Donasi
                    </a>
                    <a href="{{ route('lapor-kasus.public') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                              {{ request()->routeIs('lapor-kasus.public') ? 'bg-pink-50 text-pink-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        Lapor Kasus
                    </a>
                    <a href="{{ route('kucing.public') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                              {{ request()->routeIs('kucing.public') ? 'bg-pink-50 text-pink-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        Kucing
                    </a>
                </div>

                {{-- Right Side: Auth Buttons --}}
                <div class="hidden lg:flex items-center gap-3">
                    @auth
                        <a href="{{ route('profil') }}" class="flex items-center gap-3 rounded-full bg-gray-50 px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-pink-50 hover:text-pink-600">
                            <span class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-pink-100 text-sm font-bold text-pink-600">
                                @if(auth()->user()->foto_profil)
                                    <img src="{{ route('media.public', ['path' => auth()->user()->foto_profil]) }}" alt="Foto profil" class="h-full w-full object-cover">
                                @else
                                    {{ strtoupper(substr(auth()->user()->nama_lengkap ?? 'S', 0, 1)) }}
                                @endif
                            </span>
                            <span>Hai, {{ strtok(auth()->user()->nama_lengkap ?? 'Sobat', ' ') }}</span>
                        </a>
                        <form method="POST" action="{{ route('logout', absolute: false) }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-5 py-2 text-sm font-semibold text-white bg-pink-500 hover:bg-pink-600 rounded-full transition shadow-sm">
                            Registrasi
                        </a>
                    @endauth
                </div>

                {{-- Mobile Menu Button --}}
                <button @click="mobileOpen = !mobileOpen" class="rounded-xl p-2 transition hover:bg-gray-100 lg:hidden">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="mobileOpen" x-cloak x-transition class="border-t border-gray-100 pb-4 lg:hidden">
                <div class="flex flex-col gap-1 pt-3">
                    <a href="{{ route('home') }}" class="rounded-xl px-4 py-3 text-sm font-medium {{ request()->routeIs('home') ? 'bg-pink-50 text-pink-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        Beranda
                    </a>
                    <a href="{{ route('edukasi') }}" class="rounded-xl px-4 py-3 text-sm font-medium {{ request()->routeIs('edukasi') ? 'bg-pink-50 text-pink-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        Edukasi & Komunitas
                    </a>
                    <a href="{{ route('donasi.public') }}" class="rounded-xl px-4 py-3 text-sm font-medium {{ request()->routeIs('donasi.public') ? 'bg-pink-50 text-pink-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        Donasi
                    </a>
                    <a href="{{ route('lapor-kasus.public') }}" class="rounded-xl px-4 py-3 text-sm font-medium {{ request()->routeIs('lapor-kasus.public') ? 'bg-pink-50 text-pink-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        Lapor Kasus
                    </a>
                    <a href="{{ route('kucing.public') }}" class="rounded-xl px-4 py-3 text-sm font-medium {{ request()->routeIs('kucing.public') ? 'bg-pink-50 text-pink-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        Kucing
                    </a>

                    <div class="border-t border-gray-100 mt-2 pt-3 flex flex-col gap-1">
                        @auth
                            <a href="{{ route('profil') }}" class="flex items-center gap-3 rounded-xl bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700">
                                <span class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-pink-100 text-sm font-bold text-pink-600">
                                    @if(auth()->user()->foto_profil)
                                        <img src="{{ route('media.public', ['path' => auth()->user()->foto_profil]) }}" alt="Foto profil" class="h-full w-full object-cover">
                                    @else
                                        {{ strtoupper(substr(auth()->user()->nama_lengkap ?? 'S', 0, 1)) }}
                                    @endif
                                </span>
                                <span>Hai, {{ strtok(auth()->user()->nama_lengkap ?? 'Sobat', ' ') }}</span>
                            </a>
                            <form method="POST" action="{{ route('logout', absolute: false) }}">
                                @csrf
                                <button type="submit" class="w-full rounded-xl px-4 py-3 text-left text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="rounded-xl px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="rounded-xl bg-pink-500 px-4 py-3 text-center text-sm font-semibold text-white hover:bg-pink-600">
                                Registrasi
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- ==================== BANNER PERINGATAN ==================== --}}
    <div class="sticky top-16 z-40 bg-red-500 text-white">
        <div class="mx-auto hidden max-w-7xl items-center justify-center gap-2 px-4 py-2 text-center text-sm sm:flex">
            <span>&#9888;</span>
            <p class="leading-5">Dilarang membuang kucing di lingkungan kampus UNESA! Jika menemukan kucing sakit, terlantar atau pelaku pembuangan, segera laporkan melalui website ini.</p>
        </div>
        <div class="overflow-hidden py-2 text-[11px] sm:hidden">
            <div class="mobile-marquee">
                <span class="mobile-marquee__content">&#9888; Dilarang membuang kucing di lingkungan kampus UNESA! Jika menemukan kucing sakit, terlantar atau pelaku pembuangan, segera laporkan melalui website ini.</span>
                <span class="mobile-marquee__content" aria-hidden="true">&#9888; Dilarang membuang kucing di lingkungan kampus UNESA! Jika menemukan kucing sakit, terlantar atau pelaku pembuangan, segera laporkan melalui website ini.</span>
            </div>
        </div>
    </div>

    {{-- ==================== KONTEN UTAMA ==================== --}}
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <div class="pointer-events-none fixed bottom-4 right-4 z-40 hidden sm:block sm:bottom-6 sm:right-6">
        <div x-show="!isAwake" x-transition.opacity.duration.200ms class="flex items-end justify-end">
            <dotlottie-wc
                src="https://lottie.host/235278d2-1762-4b32-abb2-5698e8c1dc47/uix8tWATbv.json"
                style="width: 160px; height: 100px"
                autoplay
                loop
            ></dotlottie-wc>
        </div>
    </div>

    {{-- ==================== FOOTER ==================== --}}
    <footer class="bg-gray-900 text-white">
        {{-- Wave Decoration --}}
        <div class="w-full">
            <svg viewBox="0 0 1440 120" class="w-full h-12 sm:h-16 text-gray-900" preserveAspectRatio="none">
                <path fill="currentColor" d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 -mt-1">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                {{-- Brand --}}
                <div class="md:col-span-1">
                    <div class="mb-4">
                        <img src="{{ asset('images/logojagasatwa.png') }}" alt="Logo JagaSatwa" class="h-16 w-16 rounded-full object-cover">
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Komunitas Peduli Hewan Kampus<br>
                        Universitas Negeri Surabaya
                    </p>
                    <div class="flex gap-3 mt-4">
                        <a href="https://www.instagram.com/jagasatwa.unesa/" target="_blank" rel="noopener noreferrer" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 hover:bg-pink-500 text-gray-400 hover:text-white transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://wa.me/6289620048593" target="_blank" rel="noopener noreferrer" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 hover:bg-green-500 text-gray-400 hover:text-white transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </a>
                        <a href="https://www.tiktok.com/@jagasatwa.unesa" target="_blank" rel="noopener noreferrer" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 hover:bg-white hover:text-gray-900 text-gray-400 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25h-3.31v13.17a2.84 2.84 0 1 1-2.84-2.84c.23 0 .45.03.66.08V9.48a6.18 6.18 0 0 0-.66-.04A6.16 6.16 0 1 0 15.84 15.6V8.92a8.12 8.12 0 0 0 4.75 1.53V7.14c-.34 0-.67-.15-1-.45Z"/></svg>
                        </a>
                        <a href="mailto:inijagasatwa@gmail.com" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 hover:bg-blue-500 text-gray-400 hover:text-white transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Menu</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-pink-400 transition">Beranda</a></li>
                        <li><a href="{{ route('edukasi') }}" class="text-sm text-gray-400 hover:text-pink-400 transition">Edukasi & Komunitas</a></li>
                        <li><a href="{{ route('kucing.public') }}" class="text-sm text-gray-400 hover:text-pink-400 transition">Data Kucing</a></li>
                    </ul>
                </div>

                {{-- Actions --}}
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Aksi</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('donasi.public') }}" class="text-sm text-gray-400 hover:text-pink-400 transition">Kirim Donasi</a></li>
                        <li><a href="{{ route('lapor-kasus.public') }}" class="text-sm text-gray-400 hover:text-pink-400 transition">Lapor Kasus</a></li>
                        @guest
                            <li><a href="{{ route('register') }}" class="text-sm text-gray-400 hover:text-pink-400 transition">Daftar Akun</a></li>
                        @endguest
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Kontak</h4>
                    <ul class="space-y-2.5">
                        <li class="text-sm text-gray-400">
                            <span class="block text-gray-500">Alamat</span>
                            Jl. Ketintang, Surabaya 60231
                        </li>
                        <li class="text-sm text-gray-400">
                            <span class="block text-gray-500">Email</span>
                            inijagasatwa@gmail.com
                        </li>
                        <li class="text-sm text-gray-400">
                            <span class="block text-gray-500">Instagram</span>
                            @jagasatwa.unesa
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="border-t border-gray-800 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} JagaSatwa UNESA. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
