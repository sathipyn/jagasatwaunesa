<x-layouts.front-end-layout>
    <section class="bg-[linear-gradient(180deg,_#fff7f9_0%,_#ffffff_72%)] py-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-sm font-semibold text-pink-500">Akun saya</p>
                <h1 class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">Kelola profil pengguna</h1>
                <p class="mt-3 text-sm leading-6 text-gray-500 sm:text-base">
                    Edit informasi akun dan foto profil agar identitasmu tampil rapi di seluruh aktivitas JagaSatwa.
                </p>
            </div>

            <div class="mt-10">
                <livewire:profil-user-form />
            </div>
        </div>
    </section>
</x-layouts.front-end-layout>
