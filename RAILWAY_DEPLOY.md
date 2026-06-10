# Railway Deploy Guide untuk JagaSatwa

Panduan singkat biar deploy ke Railway sesuai kondisi project ini.

## Yang perlu kamu bawa

- Database backup: `jagasatwa_db.sql`
- File upload user: `storage/app/public`
- File private yang memang dipakai app: `storage/app/private`
- Aset statis web: `public/images`

Catatan:
- `public/images` biasanya ikut deploy dari repo, jadi backup manual hanya perlu kalau kamu pernah ubah file itu langsung di server.
- Upload publik di app ini disajikan lewat route `/media/{path}`, bukan lewat folder storage bawaan Laravel.

## Kenapa pakai MySQL

Project ini memang pakai MySQL.
- Ada migration yang pakai fitur MySQL untuk JSON.
- Jadi di Railway, pilih service **MySQL**, bukan Postgres.

## Environment variables yang dipakai

Set ini di service app Railway:

```env
APP_NAME=Jagasatwa
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-railway-kamu
APP_KEY=base64:...

DB_CONNECTION=mysql
DB_HOST=...
DB_PORT=...
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=public
LOG_CHANNEL=stderr
```

Catatan:
- `APP_KEY` bisa diambil dari `.env` lokal yang sudah ada, atau digenerate sekali lalu disimpan di Railway.
- Aplikasi ini pakai session, cache, dan queue berbasis database, jadi tabel hasil migration harus ikut tersedia di database Railway.

## File yang sudah disiapkan di repo

- [`railway/init-app.sh`](railway/init-app.sh) menjalankan `migrate` dan cache Laravel.
- [`railway/run-worker.sh`](railway/run-worker.sh) untuk queue worker.
- [`railway/run-cron.sh`](railway/run-cron.sh) untuk scheduler.

## Urutan deploy

1. Push repo ke GitHub.
2. Buat project baru di Railway dari repo GitHub.
3. Tambahkan service **MySQL**.
4. Deploy service app Laravel.
5. Import `jagasatwa_db.sql` ke database Railway.
6. Set environment variables di atas, termasuk `APP_KEY` dan kredensial MySQL dari Railway.
7. Pastikan frontend dibuild dengan `npm run build`.
8. Jika Railway tidak auto-detect start command, pakai:

```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

9. Set pre-deploy command ke:

```bash
chmod +x ./railway/init-app.sh && sh ./railway/init-app.sh
```

10. Tambahkan persistent volume ke `storage/app` supaya upload publik dan private tidak hilang.
11. Setelah domain Railway aktif, update `APP_URL`.
12. Redeploy sekali lagi.

## Storage dan upload

Karena file upload harus tetap ada setelah redeploy, storage harus persisten.

Paling aman:
- mount volume ke folder `storage/app`
- kalau Railway UI memaksa satu path per volume, pastikan minimal `storage/app/public` dan `storage/app/private` sama-sama ada volume/persistennya

Kalau storage tidak persisten:
- foto kucing bisa hilang
- bukti laporan bisa hilang
- foto profil bisa hilang

## Setelah live

- Cek login dan logout
- Cek upload gambar di laporan, kucing, edukasi, donasi, dan profil
- Cek apakah gambar tampil lewat route `/media/...`
- Cek admin panel
- Cek queue worker dan cron hanya kalau nanti kamu benar-benar pakai job atau scheduler

Catatan cache publik:
- Data yang ditambah dari Filament akan langsung tersimpan ke database Railway.
- Halaman publik yang pakai `Cache::remember(...)` bisa telat update sampai 10 menit.
- Jadi kalau kamu tambah kucing/edukasi/kegiatan lalu belum muncul di homepage atau list, itu biasanya karena cache, bukan karena datanya gagal tersimpan.

## Backup yang disarankan

Simpan satu folder backup yang isinya:
- `jagasatwa_db.sql`
- `.env`
- `storage/app/public`
- `storage/app/private`
- `public/images`
