<x-layouts.front-end-layout>
    <div class="flex min-h-screen items-center justify-center bg-pink-50/40 px-4 py-12">
        <div class="w-full max-w-md rounded-[1.75rem] border border-pink-100 bg-white p-8 shadow-xl shadow-pink-100/40">
            <h1 class="text-2xl font-extrabold text-gray-900">Konfirmasi password</h1>
            <p class="mt-2 text-sm leading-6 text-gray-500">
                Masukkan password untuk melanjutkan aksi yang membutuhkan keamanan tambahan.
            </p>

            @if($errors->any())
                <div class="mt-5 rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-600">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm.store', absolute: false) }}" class="mt-6 space-y-5">
                @csrf
                <div>
                    <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autofocus
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 outline-none transition focus:border-pink-300 focus:ring-2 focus:ring-pink-200"
                    >
                </div>

                <button type="submit" class="w-full rounded-xl bg-pink-500 py-3 font-semibold text-white shadow-lg shadow-pink-200 transition hover:bg-pink-600">
                    Konfirmasi
                </button>
            </form>
        </div>
    </div>
</x-layouts.front-end-layout>
