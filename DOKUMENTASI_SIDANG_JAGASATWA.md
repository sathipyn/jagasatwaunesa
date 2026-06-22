# Dokumentasi Sidang Project JagaSatwa

Dokumen ini dibuat sebagai panduan singkat untuk menjelaskan isi project saat sidang.
Tujuannya supaya kamu bisa menjawab pertanyaan seperti:
- web ini dibuat pakai apa
- urutannya dari mana dulu
- file mana yang mengatur fitur tertentu
- alur data dari form sampai masuk database

## 1. Gambaran Project

JagaSatwa adalah web informasi dan pengelolaan satwa, khususnya kucing kampus.
Website ini punya dua bagian utama:
- bagian publik untuk pengunjung
- bagian admin untuk mengelola data

Fitur yang ada di project ini antara lain:
- halaman beranda
- data kucing
- detail kucing
- edukasi dan kegiatan
- donasi
- laporan kasus
- komentar
- adopsi
- profil pengguna
- panel admin

## 2. Teknologi Yang Dipakai

Project ini dibangun dengan:
- Laravel 12 sebagai backend utama
- Livewire untuk form interaktif tanpa bikin SPA penuh
- Filament untuk admin panel CRUD
- MySQL sebagai database
- Blade sebagai template view
- Tailwind CSS untuk styling
- Railway untuk deployment

Kalau ditanya di sidang, penjelasan gampangnya:
- Laravel menangani logika aplikasi dan routing
- Blade menangani tampilan halaman
- Livewire menangani form yang interaktif
- Filament dipakai untuk panel admin
- MySQL menyimpan semua data

## 3. Struktur Folder Penting

Bagian-bagian utama project:

- `routes/web.php`
  - mengatur URL halaman publik
  - mengatur route submit form
  - mengatur route media `/media/{path}`

- `app/Models`
  - berisi model database seperti `Kucing`, `LaporanKasus`, `Donasi`, `Edukasi`, `Kegiatan`, `Adopsi`

- `app/Livewire`
  - berisi komponen form interaktif seperti:
    - `LaporKasusForm`
    - `DonasiForm`
    - `AdopsiPublicForm`
    - `KucingKomentar`
    - `PostinganKomentar`
    - `ProfilUserForm`

- `app/Filament/Resources`
  - berisi CRUD admin seperti:
    - data kucing
    - edukasi
    - kegiatan
    - donasi
    - laporan kasus
    - komentar
    - adopsi

- `resources/views/pages`
  - berisi halaman publik

- `resources/views/livewire`
  - berisi tampilan form Livewire

- `database/migrations`
  - berisi struktur tabel database

- `config/filesystems.php`
  - mengatur penyimpanan file upload

- `config/livewire.php`
  - mengatur temporary upload Livewire

- `railway/init-app.sh`
  - script inisialisasi deployment

## 4. Urutan Pembuatan Web

Kalau kamu mau jelaskan urutan pembuatannya, bisa pakai alur ini:

### Langkah 1: Tentukan kebutuhan fitur
Pertama, tentukan halaman apa saja yang dibutuhkan.
Contohnya:
- halaman publik
- form laporan kasus
- data kucing
- adopsi
- donasi
- panel admin

### Langkah 2: Buat database
Setelah kebutuhan jelas, buat tabel database lewat migration.
Contoh tabel penting:
- `kucing`
- `laporan_kasus`
- `donasi`
- `edukasi`
- `kegiatan`
- `adopsi`
- `komentar`

### Langkah 3: Buat model
Model dipakai supaya Laravel bisa berinteraksi dengan tabel database.
Contoh:
- `Kucing` untuk tabel `kucing`
- `LaporanKasus` untuk tabel `laporan_kasus`

### Langkah 4: Buat route
Route menentukan URL mana menuju halaman apa.
Contoh:
- `/` untuk beranda
- `/kucing` untuk daftar kucing
- `/lapor-kasus` untuk form laporan
- `/adopsi` untuk halaman adopsi

### Langkah 5: Buat tampilan Blade
Blade dipakai untuk tampilan halaman yang dilihat user.
File Blade biasanya ada di:
- `resources/views/pages`
- `resources/views/livewire`

### Langkah 6: Buat komponen interaktif
Kalau ada form yang perlu validasi dan simpan data tanpa reload penuh, pakai Livewire.
Contohnya:
- form laporan kasus
- form donasi
- form komentar kucing

### Langkah 7: Buat admin panel
Untuk input data dari pihak admin, project ini memakai Filament.
Admin bisa tambah, edit, hapus, dan lihat data dengan lebih cepat.

### Langkah 8: Atur upload file
Karena ada upload foto, file harus disimpan ke storage.
Di project ini:
- upload publik disimpan di disk `public`
- file ditampilkan lewat route `/media/{path}`

### Langkah 9: Deploy
Setelah lokal selesai, project di-deploy ke Railway.
Biasanya yang penting:
- env production benar
- database sudah jalan
- migrate sudah dieksekusi
- storage persisten

## 5. Alur Fitur Per Fitur

### A. Halaman Beranda
File utama:
- [routes/web.php](routes/web.php)
- `resources/views/pages/beranda.blade.php`

Alurnya:
- route mengambil data dari database
- data dicache beberapa menit supaya loading lebih cepat
- data ditampilkan di halaman beranda

### B. Data Kucing
File utama:
- [app/Filament/Resources/Kucings/KucingResource.php](app/Filament/Resources/Kucings/KucingResource.php)
- [app/Models/Kucing.php](app/Models/Kucing.php)
- `resources/views/pages/kucing.blade.php`
- `resources/views/pages/kucing-detail.blade.php`

Alurnya:
- admin menambah kucing lewat Filament
- data masuk ke tabel `kucing`
- halaman publik membaca data itu
- detail kucing menampilkan profil lengkap dan komentar

### C. Form Laporan Kasus
File utama:
- `app/Livewire/LaporKasusForm.php`
- `resources/views/livewire/lapor-kasus-form.blade.php`
- `routes/web.php`
- `app/Models/LaporanKasus.php`

Alurnya:
- user isi form laporan
- Livewire melakukan validasi
- file bukti disimpan ke storage
- data laporan disimpan ke tabel `laporan_kasus`
- riwayat laporan ditampilkan di sisi kanan form

### D. Donasi
File utama:
- `app/Livewire/DonasiForm.php`
- `resources/views/livewire/donasi-form.blade.php`
- `app/Filament/Resources/Donasis/DonasiResource.php`

Alurnya:
- user isi data donasi
- upload bukti transfer
- data disimpan
- admin bisa verifikasi dan memberi status lanjutan

### E. Adopsi
File utama:
- `app/Livewire/AdopsiPublicForm.php`
- `resources/views/livewire/adopsi-public-form.blade.php`
- `app/Filament/Resources/Adopsis/AdopsiResource.php`

Alurnya:
- user pilih kucing yang open adopsi
- isi form pengajuan
- data masuk ke database
- admin memproses status adopsi

### F. Komentar
File utama:
- `app/Livewire/KucingKomentar.php`
- `app/Livewire/PostinganKomentar.php`
- `resources/views/livewire/kucing-komentar.blade.php`
- `resources/views/livewire/postingan-komentar.blade.php`

Alurnya:
- user menulis komentar
- komentar disimpan ke tabel terkait
- jumlah komentar ditampilkan di halaman detail

### G. Edukasi dan Kegiatan
File utama:
- `app/Filament/Resources/Edukasis/EdukasiResource.php`
- `app/Filament/Resources/Kegiatans/KegiatanResource.php`
- `resources/views/pages/edukasi.blade.php`
- `resources/views/pages/kegiatan-detail.blade.php`

Alurnya:
- admin membuat artikel edukasi atau kegiatan
- data diatur agar bisa dipublish atau tidak
- halaman publik menampilkan konten yang sudah dipublish

### H. Profil User
File utama:
- `app/Livewire/ProfilUserForm.php`
- `resources/views/livewire/profil-user-form.blade.php`

Alurnya:
- user edit data profil
- foto profil bisa diupload
- data disimpan ke database dan storage

## 6. Penjelasan Singkat Kalau Ditanya Dosen

Kalau kamu diminta menjelaskan project secara lisan, kamu bisa bilang:

> Project ini dibangun dengan Laravel sebagai backend, Blade sebagai tampilan, Livewire untuk form interaktif, dan Filament untuk panel admin. Database yang dipakai MySQL. Alur kerja dimulai dari pembuatan migration, model, route, view, lalu komponen Livewire dan resource Filament. Data dari form divalidasi dulu, disimpan ke database, dan jika ada file upload disimpan ke storage.

## 7. Alur Data yang Paling Penting

Pola umum di project ini seperti ini:

1. User membuka halaman
2. Route memanggil data dari model
3. Data diolah atau dicache
4. View menampilkan data
5. Kalau user submit form, Livewire atau route melakukan validasi
6. Data disimpan ke database
7. File upload disimpan ke storage
8. Admin bisa melihat dan mengelola datanya lewat Filament

## 8. Hal Yang Perlu Diingat Saat Sidang

- Migration adalah struktur tabel
- Model adalah penghubung ke database
- Route adalah pengatur URL
- Blade adalah tampilan
- Livewire adalah form interaktif
- Filament adalah admin panel
- Storage dipakai untuk file upload
- Cache dipakai untuk mempercepat halaman publik

## 9. Catatan Deploy Railway

Saat deploy ke Railway, yang penting dicek:
- `APP_URL`
- kredensial database
- `FILESYSTEM_DISK=public`
- `php artisan migrate --force`
- storage volume supaya file upload tidak hilang

## 10. Ringkasan Cepat

Kalau disuruh ringkas banget:
- Laravel untuk backend
- Livewire untuk form
- Filament untuk admin
- MySQL untuk data
- Blade untuk UI
- Railway untuk hosting

