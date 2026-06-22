# Dokumentasi Sidang Project JagaSatwa

Dokumen ini disusun sebagai panduan presentasi sidang untuk menjelaskan bagaimana website JagaSatwa dibangun, teknologi apa saja yang dipakai, dan bagian mana yang menangani fitur tertentu.

Tujuan dokumen ini:
- membantu kamu menjelaskan project dari awal sampai jadi
- memudahkan menjawab pertanyaan dosen tentang framework, bahasa, dan alur data
- menjadi peta cepat untuk melihat file penting di project

## 1. Gambaran Umum

JagaSatwa adalah website untuk informasi dan pengelolaan satwa kampus, terutama kucing. Website ini punya dua sisi utama:

1. Sisi publik untuk pengunjung umum.
2. Sisi admin untuk mengelola konten dan data.

Fitur utama yang tersedia:
- beranda
- data kucing
- detail kucing
- edukasi
- kegiatan
- donasi
- laporan kasus
- adopsi
- komentar
- profil pengguna
- panel admin

## 2. Teknologi Yang Dipakai

| Lapisan | Teknologi | Fungsi |
|---|---|---|
| Backend | PHP 8.2 | Bahasa utama untuk menjalankan Laravel |
| Framework utama | Laravel 12 | Mengatur route, model, migrasi, validasi, auth, storage, cache |
| UI server-rendered | Blade | Template untuk halaman web |
| Interaksi form | Livewire | Form dinamis tanpa full reload |
| Admin panel | Filament 4 | CRUD admin yang cepat dan terstruktur |
| Styling | Tailwind CSS 4 | Mengatur tampilan dan responsif |
| Build asset | Vite | Build CSS dan JavaScript |
| Database | MySQL | Menyimpan semua data aplikasi |
| Upload file | Laravel Storage | Menyimpan foto, bukti, dan file upload |
| Deploy | Railway | Hosting aplikasi dan database |

Kalau ditanya di sidang, penjelasan singkatnya:
- Laravel dipakai sebagai kerangka utama aplikasi.
- Blade dipakai untuk tampilan halaman.
- Livewire dipakai untuk form yang interaktif.
- Filament dipakai untuk halaman admin.
- MySQL dipakai untuk menyimpan data.
- Tailwind dipakai untuk styling.
- Vite dipakai untuk build aset frontend.

## 3. Fungsi Tiap Teknologi

### Laravel
Laravel dipakai untuk:
- routing URL
- validasi data form
- query database
- relasi antar tabel
- caching
- auth login dan registrasi
- file storage
- middleware

File yang paling sering dipakai untuk alur Laravel:
- [routes/web.php](routes/web.php)
- [app/Models/Kucing.php](app/Models/Kucing.php)
- [app/Models/Donasi.php](app/Models/Donasi.php)
- [app/Models/LaporanKasus.php](app/Models/LaporanKasus.php)

### Blade
Blade dipakai untuk halaman HTML yang ditampilkan ke user.

Contoh file Blade penting:
- [resources/views/pages/beranda.blade.php](resources/views/pages/beranda.blade.php)
- [resources/views/pages/kucing.blade.php](resources/views/pages/kucing.blade.php)
- [resources/views/pages/donasi.blade.php](resources/views/pages/donasi.blade.php)
- [resources/views/pages/lapor-kasus.blade.php](resources/views/pages/lapor-kasus.blade.php)

### Livewire
Livewire dipakai untuk form yang perlu interaksi langsung, validasi real time, dan submit data tanpa bikin halaman penuh di-refresh.

Contoh komponen Livewire:
- [app/Livewire/LaporKasusForm.php](app/Livewire/LaporKasusForm.php)
- [app/Livewire/DonasiForm.php](app/Livewire/DonasiForm.php)
- [app/Livewire/AdopsiPublicForm.php](app/Livewire/AdopsiPublicForm.php)
- [app/Livewire/KucingKomentar.php](app/Livewire/KucingKomentar.php)
- [app/Livewire/PostinganKomentar.php](app/Livewire/PostinganKomentar.php)
- [app/Livewire/ProfilUserForm.php](app/Livewire/ProfilUserForm.php)

### Filament
Filament dipakai untuk admin panel. Admin bisa:
- menambah data
- mengedit data
- menghapus data
- mengatur publish atau tidak
- mengatur data yang tampil di publik

Contoh resource Filament:
- [app/Filament/Resources/Kucings/KucingResource.php](app/Filament/Resources/Kucings/KucingResource.php)
- [app/Filament/Resources/Donasis/DonasiResource.php](app/Filament/Resources/Donasis/DonasiResource.php)
- [app/Filament/Resources/LaporanKasuses/LaporanKasusResource.php](app/Filament/Resources/LaporanKasuses/LaporanKasusResource.php)
- [app/Filament/Resources/Edukasis/EdukasiResource.php](app/Filament/Resources/Edukasis/EdukasiResource.php)
- [app/Filament/Resources/Kegiatans/KegiatanResource.php](app/Filament/Resources/Kegiatans/KegiatanResource.php)

### Tailwind CSS
Tailwind dipakai untuk styling tampilan:
- layout
- warna
- spacing
- responsive mobile
- card design
- tombol
- badge

File utama styling:
- [resources/css/app.css](resources/css/app.css)

### Vite
Vite dipakai untuk membangun asset frontend.

Di project ini, Vite membantu:
- compile CSS Tailwind
- compile JavaScript frontend
- membuat build production lebih ringan

File terkait:
- [package.json](package.json)

### MySQL
MySQL dipakai untuk menyimpan:
- data user
- data kucing
- data donasi
- data edukasi
- data kegiatan
- data laporan kasus
- data adopsi
- komentar

Struktur tabel dibuat lewat migration di folder `database/migrations`.

### Railway
Railway dipakai untuk deploy aplikasi agar bisa diakses online.

Yang penting di Railway:
- app service
- MySQL service
- environment variables
- storage persisten
- migration saat deploy

File deploy penting:
- [RAILWAY_DEPLOY.md](RAILWAY_DEPLOY.md)
- [railway/init-app.sh](railway/init-app.sh)

## 4. Struktur Folder Penting

| Folder / File | Fungsi |
|---|---|
| `routes/web.php` | Route halaman publik dan route submit form |
| `app/Models` | Model database |
| `app/Livewire` | Komponen form interaktif |
| `app/Filament/Resources` | CRUD admin |
| `resources/views/pages` | View halaman publik |
| `resources/views/livewire` | View komponen Livewire |
| `database/migrations` | Struktur tabel database |
| `config/filesystems.php` | Setting storage upload |
| `config/livewire.php` | Setting temporary upload Livewire |
| `resources/css/app.css` | Styling utama |
| `package.json` | Build asset frontend |
| `composer.json` | Dependency backend dan script Laravel |

## 5. Urutan Pembuatan Project

Kalau dosen tanya urutan pengerjaan, kamu bisa jelaskan seperti ini:

### Langkah 1: Analisis kebutuhan
Pertama, tentukan fitur yang dibutuhkan.
Contohnya:
- informasi kucing
- laporan kasus
- donasi
- adopsi
- edukasi
- kegiatan
- admin panel

### Langkah 2: Buat database
Setelah kebutuhan jelas, buat struktur tabel lewat migration.
Contoh tabel:
- `kucing`
- `donasi`
- `laporan_kasus`
- `edukasi`
- `kegiatan`
- `adopsi`
- `komentar`

### Langkah 3: Buat model
Model digunakan untuk menghubungkan aplikasi dengan tabel database.
Contoh:
- `Kucing`
- `Donasi`
- `LaporanKasus`

### Langkah 4: Buat route
Route menentukan halaman mana yang diakses lewat URL tertentu.

Contoh route:
- `/` untuk beranda
- `/kucing` untuk daftar kucing
- `/lapor-kasus` untuk laporan kasus
- `/donasi-publik` untuk halaman donasi publik

### Langkah 5: Buat halaman Blade
Blade dipakai untuk menampilkan UI halaman publik.

### Langkah 6: Buat komponen Livewire
Livewire dipakai untuk form yang lebih interaktif.

### Langkah 7: Buat admin panel Filament
Admin panel dipakai agar data bisa dikelola lewat dashboard.

### Langkah 8: Atur file upload
Upload foto disimpan ke storage, lalu ditampilkan kembali lewat route media.

### Langkah 9: Testing dan deploy
Setelah fitur selesai, project diuji lalu dipasang di Railway.

## 6. Alur Arsitektur Aplikasi

Alur umum aplikasi:

1. User membuka halaman.
2. Route di `routes/web.php` memanggil model atau komponen.
3. Data diambil dari database.
4. Data bisa dicache untuk mempercepat loading.
5. Blade menampilkan data ke browser.
6. Jika user submit form, Livewire atau route melakukan validasi.
7. Data disimpan ke database.
8. File upload disimpan ke storage.
9. Admin mengelola data melalui Filament.

## 7. Peta Fitur Ke File

### A. Beranda
File utama:
- [routes/web.php](routes/web.php)
- [resources/views/pages/beranda.blade.php](resources/views/pages/beranda.blade.php)

Yang terjadi:
- route mengambil data beranda
- data kucing, edukasi, dan kegiatan diambil dari database
- data ditampilkan di home
- beberapa data memakai cache agar lebih cepat

Catatan penting:
- preview kucing di beranda sekarang bisa dipilih dari admin lewat field `tampil_di_beranda`
- urutan tampilnya bisa diatur lewat `urutan_beranda`

### B. Data Kucing
File utama:
- [app/Filament/Resources/Kucings/KucingResource.php](app/Filament/Resources/Kucings/KucingResource.php)
- [app/Models/Kucing.php](app/Models/Kucing.php)
- [resources/views/pages/kucing.blade.php](resources/views/pages/kucing.blade.php)
- [resources/views/pages/kucing-detail.blade.php](resources/views/pages/kucing-detail.blade.php)

Yang terjadi:
- admin menambah kucing lewat Filament
- data disimpan di tabel `kucing`
- halaman publik menampilkan daftar kucing
- halaman detail menampilkan profil lengkap

Fitur penting:
- `open_adopsi` untuk menandai kucing yang bisa diajukan adopsi
- `tampil_di_beranda` untuk memilih kucing yang muncul di homepage
- `urutan_beranda` untuk mengatur prioritas tampil

### C. Laporan Kasus
File utama:
- [app/Livewire/LaporKasusForm.php](app/Livewire/LaporKasusForm.php)
- [resources/views/livewire/lapor-kasus-form.blade.php](resources/views/livewire/lapor-kasus-form.blade.php)
- [routes/web.php](routes/web.php)
- [app/Models/LaporanKasus.php](app/Models/LaporanKasus.php)

Yang terjadi:
- user mengisi form laporan
- Livewire memvalidasi input
- file bukti pendukung disimpan ke storage
- laporan disimpan ke database
- riwayat laporan ditampilkan di sisi kanan form

### D. Donasi
File utama:
- [app/Livewire/DonasiForm.php](app/Livewire/DonasiForm.php)
- [resources/views/livewire/donasi-form.blade.php](resources/views/livewire/donasi-form.blade.php)
- [routes/web.php](routes/web.php)
- [app/Filament/Resources/Donasis/DonasiResource.php](app/Filament/Resources/Donasis/DonasiResource.php)

Yang terjadi:
- user mengisi data donasi dan upload bukti transfer
- data masuk ke tabel `donasi`
- admin bisa memberi status penggunaan dana
- halaman publik menampilkan contoh penggunaan donasi

### E. Adopsi
File utama:
- [app/Livewire/AdopsiPublicForm.php](app/Livewire/AdopsiPublicForm.php)
- [resources/views/livewire/adopsi-public-form.blade.php](resources/views/livewire/adopsi-public-form.blade.php)
- [app/Filament/Resources/Adopsis/AdopsiResource.php](app/Filament/Resources/Adopsis/AdopsiResource.php)

Yang terjadi:
- user memilih kucing yang open adopsi
- form pengajuan diproses
- data masuk database
- admin memantau status adopsi

### F. Komentar
File utama:
- [app/Livewire/KucingKomentar.php](app/Livewire/KucingKomentar.php)
- [app/Livewire/PostinganKomentar.php](app/Livewire/PostinganKomentar.php)
- [resources/views/livewire/kucing-komentar.blade.php](resources/views/livewire/kucing-komentar.blade.php)
- [resources/views/livewire/postingan-komentar.blade.php](resources/views/livewire/postingan-komentar.blade.php)

Yang terjadi:
- user menulis komentar
- komentar disimpan ke tabel komentar terkait
- jumlah komentar muncul di halaman detail

### G. Edukasi dan Kegiatan
File utama:
- [app/Filament/Resources/Edukasis/EdukasiResource.php](app/Filament/Resources/Edukasis/EdukasiResource.php)
- [app/Filament/Resources/Kegiatans/KegiatanResource.php](app/Filament/Resources/Kegiatans/KegiatanResource.php)
- [resources/views/pages/edukasi.blade.php](resources/views/pages/edukasi.blade.php)
- [resources/views/pages/kegiatan-detail.blade.php](resources/views/pages/kegiatan-detail.blade.php)

Yang terjadi:
- admin menambah artikel atau kegiatan
- data dapat diberi status publish
- halaman publik hanya menampilkan konten yang aktif

### H. Profil User
File utama:
- [app/Livewire/ProfilUserForm.php](app/Livewire/ProfilUserForm.php)
- [resources/views/livewire/profil-user-form.blade.php](resources/views/livewire/profil-user-form.blade.php)

Yang terjadi:
- user update profil
- foto profil bisa diunggah
- data disimpan ke database dan storage

## 8. Database Dan Migration

Migration dipakai untuk membuat dan mengubah struktur tabel tanpa edit manual di database.

Contoh migration penting:
- [database/migrations/2026_04_12_161727_create_kucing_table.php](database/migrations/2026_04_12_161727_create_kucing_table.php)
- [database/migrations/2026_04_23_173026_change_foto_to_json_in_kucing_table.php](database/migrations/2026_04_23_173026_change_foto_to_json_in_kucing_table.php)
- [database/migrations/2026_06_22_000001_expand_warna_kucing_column.php](database/migrations/2026_06_22_000001_expand_warna_kucing_column.php)
- [database/migrations/2026_06_22_000002_add_tampil_di_beranda_to_kucing_table.php](database/migrations/2026_06_22_000002_add_tampil_di_beranda_to_kucing_table.php)

Penjelasan yang bisa dipakai saat sidang:
- migration pertama membuat tabel dasar
- migration berikutnya mengubah tipe kolom ketika kebutuhan fitur berubah
- data lama tetap bisa dipakai tanpa bikin tabel baru dari nol

## 9. Storage Dan Upload

File upload di project ini disimpan lewat Laravel storage.

Konsepnya:
- file diunggah dari form
- file disimpan ke disk `public`
- file dipanggil lewat route `/media/{path}`

File konfigurasi:
- [config/filesystems.php](config/filesystems.php)
- [config/livewire.php](config/livewire.php)
- [routes/web.php](routes/web.php)

Hal penting untuk sidang:
- file upload publik tidak disimpan langsung di folder view
- storage dipakai supaya file lebih rapi dan aman
- route media dipakai untuk menampilkan file tanpa membuka akses folder langsung

## 10. Cache Dan Performa

Project ini memakai cache untuk beberapa halaman publik.

Contoh:
- beranda
- data kucing
- halaman donasi publik
- halaman laporan kasus publik

Tujuan cache:
- mempercepat loading
- mengurangi query ke database
- menjaga halaman tetap responsif

Hal yang bisa kamu jelaskan:
- data admin tetap tersimpan langsung di database
- tampilan publik kadang memakai cache beberapa menit
- jadi jika data baru belum muncul, biasanya menunggu cache atau melakukan refresh build key

## 11. Login Dan Auth

Sistem login dan registrasi dipakai agar:
- laporan kasus tercatat per user
- donasi punya identitas pengirim
- profil user bisa diedit
- admin bisa dibatasi aksesnya

Package yang terkait:
- [composer.json](composer.json)

Beberapa paket penting:
- Laravel Fortify untuk autentikasi
- Filament Shield untuk hak akses admin
- Livewire Flux dan Volt untuk komponen UI dan ekosistem Livewire

## 12. Build Frontend

Frontend project dibuild dengan:
- Tailwind CSS
- Vite

Perintah build yang umum:

```bash
npm install
npm run build
```

Di `composer.json` juga ada script setup dan dev yang penting:
- install dependency backend
- generate app key
- migrate database
- build asset frontend

## 13. Deploy Railway

Saat deploy ke Railway, hal yang perlu dijelaskan:

1. Buat service aplikasi Laravel.
2. Tambahkan service MySQL.
3. Set environment variable.
4. Jalankan migration.
5. Pastikan storage persisten.
6. Build frontend berhasil.

Env yang penting:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-railway-kamu
DB_CONNECTION=mysql
DB_HOST=...
DB_PORT=...
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...
FILESYSTEM_DISK=public
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

File panduan deploy:
- [RAILWAY_DEPLOY.md](RAILWAY_DEPLOY.md)

## 14. Kalimat Siap Pakai Saat Sidang

Kamu bisa pakai kalimat ini:

> Website JagaSatwa dibangun menggunakan Laravel 12 sebagai backend, Blade sebagai tampilan, Livewire untuk form interaktif, dan Filament untuk admin panel. Data disimpan di MySQL, sedangkan file upload disimpan di storage Laravel. Beberapa halaman publik memakai cache untuk mempercepat akses. Alur pengembangan dimulai dari migration, model, route, view, komponen Livewire, lalu admin resource Filament.

Kalau ditanya kenapa pakai Livewire:
> Karena beberapa form butuh validasi dan submit yang lebih interaktif tanpa membuat aplikasi jadi SPA penuh.

Kalau ditanya kenapa pakai Filament:
> Karena Filament mempercepat pembuatan panel admin CRUD dan memudahkan pengelolaan data.

Kalau ditanya kenapa pakai Blade:
> Karena Blade cocok untuk server-side rendering yang sederhana dan mudah dipelihara.

## 15. Ringkasan Cepat

- Laravel = backend utama
- Blade = tampilan halaman
- Livewire = form interaktif
- Filament = admin panel
- MySQL = database
- Tailwind = styling
- Vite = build frontend
- Railway = hosting

## 16. Catatan Praktis Untuk Kamu

Kalau kamu ingin menjelaskan project secara runtut, pakai urutan ini:

1. Jelaskan tujuan website.
2. Jelaskan teknologi yang dipakai.
3. Jelaskan struktur folder utama.
4. Jelaskan alur dari user buka halaman sampai data tersimpan.
5. Jelaskan fitur satu per satu.
6. Jelaskan deploy dan storage.

Kalau kamu mau, aku juga bisa bantu bikin versi lain dari dokumen ini:
- versi singkat 1 halaman
- versi bahasa formal skripsi
- versi tanya jawab sidang
- versi presentasi yang tinggal dibaca
