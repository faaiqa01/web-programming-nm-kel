# E-Library

E-Library adalah aplikasi manajemen perpustakaan digital berbasis Laravel yang digunakan untuk mengelola koleksi buku, peminjaman, dan akun anggota secara terpusat. Aplikasi ini mengusung antarmuka modern dengan Tailwind CSS + Flowbite serta mendukung mode gelap.

## Fitur Utama
- **Autentikasi & Role-Based Access**: Laravel Breeze menyediakan registrasi & login, sedangkan middleware role memastikan hanya admin/anggota yang mengakses menu masing-masing.
- **Dashboard per Peran**: Admin mendapatkan ringkasan jumlah buku, anggota, peminjaman dan status terbaru; anggota melihat rekap booking, pinjaman aktif, dan riwayat terkini.
- **Manajemen Kategori & Buku**: Admin mengelola kategori, menambah buku beserta cover (upload ke disk public), mengatur stok dan deskripsi.
- **Manajemen Akun Pengguna**: Admin membuat, mengubah, dan menghapus akun dengan peran admin atau anggota.
- **Peminjaman & Booking**: Anggota dapat melakukan booking via katalog; admin menyetujui atau menolak, menandai buku sebagai dipinjam ataupun dikembalikan.
- **Perhitungan Denda Otomatis**: Ketika pengembalian melewati 7 hari, sistem menghitung denda Rp1.000 per hari dan menampilkannya pada riwayat.
- **Riwayat Peminjaman Anggota**: Anggota memantau status (booking, dipinjam, dikembalikan, ditolak) dan denda dari halaman riwayat pribadi.

## Teknologi
- PHP 8.2 + Laravel 11
- MySQL/MariaDB
- Laravel Breeze (auth scaffolding)
- Tailwind CSS 3 + Flowbite + Alpine.js
- Vite sebagai asset bundler

## Instalasi & Menjalankan
1. Clone repo dan masuk ke direktori proyek.
2. Install dependensi PHP dan JavaScript:
```bash
composer install
npm install
```
3. Salin file environment lalu sesuaikan konfigurasi database/mail/disk:
```bash
cp .env.example .env
```
   Set `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, dan ubah `FILESYSTEM_DISK=public` bila ingin menyimpan cover di folder publik.
4. Generate APP_KEY (jika belum ada) dan jalankan migrasi beserta seeder admin:
```bash
php artisan key:generate
php artisan migrate --seed
```
5. Buat symbolic link storage untuk akses cover:
```bash
php artisan storage:link
```
6. Jalankan build asset untuk pengembangan:
```bash
npm run dev
```
   Gunakan `npm run build` untuk bundling produksi.
7. Mulai server Laravel lokal:
```bash
php artisan serve
```
   Aplikasi dapat diakses di http://127.0.0.1:8000.

## Akun Bawaan

| Peran | Email | Password |
|-------|---------------------|----------|
| Admin | admin@elibrary.com | password |

Akun seeder dibuat oleh AdminSeeder. Ubah password segera setelah login pertama.

Untuk menambah anggota, login sebagai admin dan gunakan menu **User**. Semua akun baru default ke peran anggota kecuali dipilih admin.

## Alur Peminjaman
1. Anggota melakukan booking buku melalui daftar buku (`member/buku`).
2. Status peminjaman dimulai sebagai `booking`.
3. Admin meninjau daftar peminjaman:
   - `Setujui` -> status menjadi `dipinjam` dan stok buku otomatis berkurang.
   - `Tolak` -> status `ditolak`.
   - `Kembalikan` -> status `dikembalikan`, stok bertambah, denda dihitung jika melewati 7 hari.
4. Anggota memonitor semua status dan denda dari halaman riwayat pribadi.

## Perintah Pengembangan Tambahan
- `php artisan migrate:fresh --seed`: reset database ketika pengembangan.
- `php artisan test`: menjalankan test suite (tambahkan test sesuai kebutuhan).
- `composer run dev`: menjalankan server PHP, queue listener, pail log, dan Vite secara paralel (lihat script di composer.json).
- `npm run serve-all`: menjalankan `npm run dev` dan `php artisan serve` secara bersamaan melalui `concurrently`.

## Struktur Katalog (Singkat)
```text
app/
  Http/Controllers/   --> logika CRUD, dashboard, peminjaman
  Http/Middleware/RoleMiddleware.php --> proteksi akses per peran
  Models/             --> Buku, Kategori, Peminjaman, User, dsb
resources/views/      --> tampilan admin dan anggota (Tailwind + Flowbite)
database/migrations/  --> skema users, bukus, peminjaman, pengembalian, denda
database/seeders/     --> akun admin default
```

## Lisensi
Proyek ini berada di bawah lisensi MIT bawaan Laravel. Silakan gunakan dan modifikasi sesuai kebutuhan institusi Anda.
