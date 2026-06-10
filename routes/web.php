<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Anggota;
use App\Models\Edukasi;
use App\Models\Kegiatan;
use App\Models\Kucing;
use App\Models\LaporanKasus;

// ==================== HALAMAN PUBLIK ====================
Route::get('/', function () {
    $kegiatanPublik = Cache::remember('public.home.kegiatan', now()->addMinutes(10), function () {
        return Kegiatan::query()
            ->where('is_published', true)
            ->orderByDesc('is_featured')
            ->orderBy('urutan')
            ->orderByDesc('tanggal_kegiatan')
            ->take(3)
            ->get();
    });

    $edukasiPublik = Cache::remember('public.home.edukasi', now()->addMinutes(10), function () {
        return Edukasi::query()
            ->where('is_published', true)
            ->orderByDesc('is_featured')
            ->orderBy('urutan')
            ->orderByDesc('published_at')
            ->take(4)
            ->get();
    });

    $kucingPublik = Cache::remember('public.home.kucing', now()->addMinutes(10), function () {
        return Kucing::query()
            ->withCount('komentar')
            ->latest()
            ->take(4)
            ->get();
    });

    $kucingCount = Cache::remember('public.home.kucing_count', now()->addMinutes(10), fn () => Kucing::count());
    $anggotaAktifCount = Cache::remember('public.home.anggota_aktif_count', now()->addMinutes(10), fn () => Anggota::where('status_keanggotaan', 'aktif')->count());

    return view('pages.beranda', compact(
        'kegiatanPublik',
        'edukasiPublik',
        'kucingPublik',
        'kucingCount',
        'anggotaAktifCount'
    ));
})->name('home');

Route::get('/edukasi', function () {
    $semuaKegiatan = Cache::remember('public.edukasi.kegiatan', now()->addMinutes(10), function () {
        return Kegiatan::query()
            ->withCount('komentarPostingan')
            ->where('is_published', true)
            ->orderByDesc('is_featured')
            ->orderBy('urutan')
            ->orderByDesc('tanggal_kegiatan')
            ->get();
    });

    $semuaEdukasi = Cache::remember('public.edukasi.artikel', now()->addMinutes(10), function () {
        return Edukasi::query()
            ->withCount('komentarPostingan')
            ->where('is_published', true)
            ->orderByDesc('is_featured')
            ->orderBy('urutan')
            ->orderByDesc('published_at')
            ->get();
    });

    return view('pages.edukasi', compact('semuaKegiatan', 'semuaEdukasi'));
})->name('edukasi');

Route::get('/edukasi/{edukasi:slug}', function (Edukasi $edukasi) {
    abort_unless($edukasi->is_published, 404);

    $edukasi->loadCount('komentarPostingan');

    return view('pages.edukasi-detail', [
        'edukasi' => $edukasi,
    ]);
})->name('edukasi.show');

Route::get('/kegiatan/{kegiatan:slug}', function (Kegiatan $kegiatan) {
    abort_unless($kegiatan->is_published, 404);

    $kegiatan->loadCount('komentarPostingan');

    return view('pages.kegiatan-detail', [
        'kegiatan' => $kegiatan,
    ]);
})->name('kegiatan.show');

Route::get('/donasi-publik', function () {
    return view('pages.donasi');
})->name('donasi.public');

Route::get('/lapor-kasus', function () {
    return view('pages.lapor-kasus');
})->name('lapor-kasus.public');

Route::post('/lapor-kasus', function (Request $request) {
    $validated = $request->validate([
        'judul_laporan' => ['required', 'string', 'max:255'],
        'kategori_kasus' => ['required', Rule::in(array_keys(LaporanKasus::kategoriKasusOptions()))],
        'deskripsi_kasus' => ['required', 'string'],
        'tanggal_laporan' => ['required', 'date'],
        'lokasi_laporan' => ['nullable', 'string', 'max:255'],
        'bukti_pendukung' => ['nullable', 'array'],
        'bukti_pendukung.*' => ['image', 'max:2048'],
    ]);

    if ($request->hasFile('bukti_pendukung')) {
        $validated['bukti_pendukung'] = collect($request->file('bukti_pendukung'))
            ->map(fn ($file) => $file->storeAs(
                'laporan-kasus',
                Str::uuid() . '.' . $file->getClientOriginalExtension(),
                'public'
            ))
            ->all();
    }

    LaporanKasus::create([
        ...$validated,
        'user_id' => $request->user()->id,
        'status_laporan' => 'Diproses',
    ]);

    return back()->with('success', 'Laporan kasus berhasil dikirim.');
})->middleware('auth')->name('lapor-kasus.store');

Route::get('/kucing', function () {
    $semuaKucing = Cache::remember('public.kucing.semua', now()->addMinutes(10), function () {
        return Kucing::withCount('komentar')->latest()->get();
    });

    $kataKunci = trim(request('cari', ''));
    $hasilKucing = $semuaKucing;

    if ($kataKunci !== '') {
        $hasilKucing = collect();
        $keyword = Str::lower($kataKunci);

        foreach ($semuaKucing as $itemKucing) {
            $teksPencarian = Str::lower(collect([
                $itemKucing->nama_kucing,
                $itemKucing->lokasi_kucing,
                $itemKucing->warna_kucing,
                $itemKucing->jenis_kelamin,
                $itemKucing->steril_kucing,
                $itemKucing->vaksin_kucing,
                $itemKucing->deskripsi,
            ])->filter()->implode(' '));

            if (str_contains($teksPencarian, $keyword)) {
                $hasilKucing->push($itemKucing);
            }
        }
    }

    $kucingOpenAdopsi = $semuaKucing->where('open_adopsi', true);
    $kucingSteril = $semuaKucing->where('steril_kucing', 'Sudah');
    $wallOfFameKucing = $kucingOpenAdopsi->take(4);

    return view('pages.kucing', compact(
        'semuaKucing',
        'kataKunci',
        'hasilKucing',
        'kucingOpenAdopsi',
        'kucingSteril',
        'wallOfFameKucing'
    ));
})->name('kucing.public');

Route::get('/kucing/{kucing}', function (Kucing $kucing) {
    $kucing->loadCount('komentar');

    return view('pages.kucing-detail', [
        'kucing' => $kucing,
    ]);
})->name('kucing.show');

Route::get('/adopsi', function () {
    return view('pages.adopsi');
})->name('adopsi.public');

Route::get('/profil', function () {
    return view('pages.profil');
})->middleware('auth')->name('profil');

Route::get('/media/{path}', function (string $path) {
    abort_unless(Storage::disk('public')->exists($path), 404);

    return response()->file(Storage::disk('public')->path($path), [
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->where('path', '.*')->name('media.public');



// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');
