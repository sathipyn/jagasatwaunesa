<x-layouts.front-end-layout>
    <div class="min-h-screen flex">

        {{-- LEFT: Pink Banner --}}
        <div class="hidden lg:flex lg:w-[44%] bg-gradient-to-br from-pink-400 to-pink-500 items-center justify-center relative overflow-hidden">
            <div class="absolute top-10 left-10 w-48 h-48 bg-pink-300 rounded-full blur-3xl opacity-40"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-pink-600 rounded-full blur-3xl opacity-20"></div>
            <div class="relative text-center text-white p-12">
                <img src="{{ asset('images/logojagasatwa.png') }}" alt="Logo JagaSatwa" class="mx-auto mb-6 h-28 w-28 rounded-full object-cover shadow-xl shadow-pink-500/30">
                <h1 class="text-4xl font-extrabold mb-4">Halo, Sobat JAGAT!</h1>
                <p class="text-pink-100 text-lg max-w-sm mx-auto">
                    Kami senang menyambutmu di keluarga JagaSatwa. Yuk, buat akunmu sekarang!
                </p>
            </div>
        </div>

        {{-- RIGHT: Form --}}
        <div class="w-full lg:w-[56%] flex items-center justify-center p-8 lg:px-10 xl:px-14">
            <div class="w-full max-w-lg">
                <div class="lg:hidden text-center mb-8">
                    <img src="{{ asset('images/logojagasatwa.png') }}" alt="Logo JagaSatwa" class="mx-auto h-20 w-20 rounded-full object-cover shadow-sm">
                    <h1 class="mt-3 text-2xl font-extrabold"><span class="text-pink-500">Jaga</span>Satwa</h1>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-1">Buat Akun Baru</h2>
                <p class="text-gray-500 mb-8">Bergabunglah dengan keluarga JagaSatwa UNESA!</p>

                @if($errors->any())
                    <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-200">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store', absolute: false) }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="redirect_to" value="{{ old('redirect_to', request('redirect_to')) }}">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autofocus
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-400 focus:border-transparent outline-none transition"
                            placeholder="Masukkan nama lengkap kamu">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">E-mail</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-400 focus:border-transparent outline-none transition"
                            placeholder="Masukkan email kamu">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-400 focus:border-transparent outline-none transition"
                            placeholder="Masukkan username kamu">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-400 focus:border-transparent outline-none transition"
                            placeholder="Minimal 8 karakter">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-400 focus:border-transparent outline-none transition"
                            placeholder="Ulangi password kamu">
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-pink-500 text-white font-semibold rounded-xl hover:bg-pink-600 transition shadow-lg shadow-pink-200">
                        Sign Up
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-8">
                    Sudah punya akun?
                    <a href="{{ route('login', request()->filled('redirect_to') ? ['redirect_to' => request('redirect_to')] : []) }}" class="text-pink-500 font-semibold hover:underline">Sign In</a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.front-end-layout>
