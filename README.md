# Sistem-KasirSistem Kasir Hidroponik

Sistem Kasir Hidroponik adalah aplikasi berbasis web yang dibuat menggunakan Laravel untuk membantu pengelolaan penjualan, produk, pengeluaran, dan laporan keuangan pada usaha hidroponik.

Fitur Utama

1. Autentikasi & User Management

Login menggunakan username dan password.

Password disimpan dalam bentuk hash.

Sistem menggunakan role Owner Hidroponik.

Logout tersedia setelah user berhasil login.

2. Manajemen Produk

Menampilkan daftar produk.

Menambahkan produk baru.

Mengubah data produk.

Mengatur harga dan stok.

Menonaktifkan produk tanpa menghapus data secara permanen.

Menampilkan informasi produk dengan stok rendah.

3. Transaksi Penjualan

Membuat transaksi penjualan baru.

Nomor transaksi dibuat secara otomatis.

Menambahkan detail produk ke transaksi.

Menghitung subtotal berdasarkan jumlah dan harga satuan.

Menghitung total transaksi secara otomatis.

Stok produk berkurang secara otomatis ketika produk ditambahkan ke transaksi.

Transaksi dapat diselesaikan menjadi transaksi berhasil.

Transaksi yang sudah selesai bersifat read-only.

Menampilkan riwayat transaksi.

4. Kategori Pengeluaran

Menambahkan kategori pengeluaran.

Mengubah kategori pengeluaran.

Menghapus kategori pengeluaran sesuai kebutuhan sistem.

Menampilkan daftar kategori pengeluaran.

5. Pengeluaran

Mencatat pengeluaran usaha.

Menentukan tanggal pengeluaran.

Memilih kategori pengeluaran.

Menyimpan jumlah pengeluaran.

Menambahkan keterangan.

Mengubah dan menghapus data pengeluaran.

Menampilkan riwayat pengeluaran.

6. Laporan Keuangan

Menampilkan total pendapatan.

Menampilkan total pengeluaran.

Menghitung saldo bersih.

Rekap keuangan berdasarkan periode bulanan atau tahunan.

Menampilkan grafik pendapatan dan pengeluaran.

Menampilkan pengeluaran berdasarkan kategori.

Menampilkan persentase net margin.

7. Dashboard

Dashboard menampilkan ringkasan kondisi usaha, meliputi:

Jumlah transaksi.

Total pendapatan.

Total pengeluaran.

Saldo bersih.

Transaksi terbaru.

Produk dengan stok rendah.

Ringkasan keuangan.

Teknologi yang Digunakan

Framework: Laravel 13

Bahasa Pemrograman: PHP 8.5+

Database: MySQL

Frontend: Blade, Bootstrap, CSS, JavaScript

Icon: Iconify / Lucide

Chart: Chart.js

Development Environment: Laragon

Arsitektur Project

Project menggunakan pendekatan berlapis agar kode lebih terstruktur dan mudah dikembangkan.

app/
├── Actions/
├── Http/
│   ├── Controllers/
│   └── Requests/
├── Models/
├── Queries/
├── Repositories/
│   └── RepositoryInterface/
└── View/
    └── Components/

resources/
└── views/
    ├── auth/
    ├── dashboard/
    ├── produk/
    ├── transaksi/
    ├── kategori_pengeluaran/
    ├── pengeluaran/
    ├── financial_report/
    └── components/

database/
├── migrations/
└── seeders/

Pola Repository

Repository digunakan untuk memisahkan proses akses data dari controller maupun action.

Action

Action digunakan untuk menangani proses bisnis tertentu, misalnya membuat transaksi, menambahkan detail transaksi, menyelesaikan transaksi, dan mencatat pengeluaran.

Query

Query digunakan untuk mengambil atau mengolah data yang dibutuhkan oleh halaman seperti dashboard dan laporan keuangan.

Blade Components

Komponen Blade digunakan agar elemen antarmuka dapat digunakan kembali, seperti:

Layout

Sidebar

Page Header

Breadcrumb

Card

Button

Table

Badge

Alert

Icon

Database

Database yang digunakan dalam project ini adalah:

db_sistem_kasir

Beberapa tabel utama:

users
produk
transaksi_penjualan
detail_transaksi
kategori_pengeluaran
pengeluaran
sessions

Relasi Utama

User
 ├── hasMany TransaksiPenjualan
 ├── hasMany Pengeluaran
 └── hasMany Produk

TransaksiPenjualan
 ├── belongsTo User
 └── hasMany DetailTransaksi

DetailTransaksi
 ├── belongsTo TransaksiPenjualan
 └── belongsTo Produk

KategoriPengeluaran
 └── hasMany Pengeluaran

Pengeluaran
 ├── belongsTo User
 └── belongsTo KategoriPengeluaran

Persyaratan Sistem

Pastikan perangkat sudah memiliki:

PHP 8.5 atau yang kompatibel dengan project.

Composer.

MySQL.

Node.js dan npm.

Laragon atau web server PHP lainnya.

Git, apabila project diambil dari repository.

Instalasi

1. Clone / Salin Project

Masuk ke folder project:

cd C:\laragon\www

Kemudian clone repository atau letakkan project pada folder:

C:\laragon\www\sistem-kasir

2. Install Dependency PHP

composer install

3. Install Dependency Frontend

npm install

4. Buat File Environment

Salin file .env.example menjadi .env.

copy .env.example .env

Pada Linux/macOS dapat menggunakan:

cp .env.example .env

5. Generate Application Key

php artisan key:generate

6. Konfigurasi Database

Sesuaikan bagian database pada .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_sistem_kasir
DB_USERNAME=root
DB_PASSWORD=

7. Jalankan Migration dan Seeder

Untuk membuat database sekaligus mengisi data awal dan data dummy:

php artisan migrate:fresh --seed

Perintah tersebut akan membuat ulang seluruh tabel dan menjalankan seeder.

Akun Login Default

Seeder menyediakan akun Owner:

Username : owner
Password : owner123
Role     : Owner Hidroponik

Catatan: Ganti password tersebut apabila aplikasi digunakan di lingkungan sebenarnya.

Menjalankan Project

Jalankan server Laravel:

php artisan serve

Aplikasi dapat diakses melalui:

http://localhost:8000

Untuk development frontend, jalankan Vite pada terminal lain:

npm run dev

Seeder Data Dummy

Project menyediakan DummyDataSeeder untuk membantu pengujian tampilan dan fitur aplikasi.

Data dummy mencakup:

Beberapa produk hidroponik.

Beberapa kategori pengeluaran.

Data transaksi penjualan dari beberapa periode.

Detail transaksi.

Data pengeluaran dari beberapa periode.

Untuk melakukan reset dan membuat ulang seluruh data dummy:

php artisan migrate:fresh --seed

Alur Transaksi Penjualan

Alur transaksi pada sistem adalah sebagai berikut:

Buat transaksi
      ↓
Tambahkan produk
      ↓
Validasi stok
      ↓
Hitung subtotal
      ↓
Kurangi stok produk
      ↓
Update total transaksi
      ↓
Selesaikan transaksi
      ↓
Transaksi menjadi completed

Transaksi yang sudah berstatus completed tidak dapat ditambahkan detail baru sehingga data transaksi yang sudah selesai tetap konsisten.

Validasi Utama

Beberapa aturan validasi yang diterapkan:

Username harus unik.

Password wajib diisi saat login.

Harga produk tidak boleh negatif.

Stok produk tidak boleh negatif.

Jumlah produk pada transaksi harus lebih dari 0.

Jumlah produk yang dijual tidak boleh melebihi stok.

Subtotal dihitung dari jumlah × harga satuan.

Kategori pengeluaran wajib dipilih.

Jumlah pengeluaran harus lebih dari 0.

Transaksi yang sudah selesai tidak dapat dimodifikasi melalui proses penambahan detail transaksi.

Struktur Modul

/auth
    Login & Logout

/dashboard
    Ringkasan sistem

/produk
    Manajemen produk

/transaksi
    Transaksi penjualan

/kategori-pengeluaran
    Manajemen kategori pengeluaran

/pengeluaran
    Manajemen pengeluaran

/laporan-keuangan
    Laporan dan analisis keuangan

Tampilan

Antarmuka menggunakan konsep dashboard modern dengan tema hijau yang menyesuaikan identitas usaha hidroponik. Komponen antarmuka dibuat reusable menggunakan Blade Components agar tampilan antarhalaman tetap konsisten.

Keamanan & Akses

Halaman utama sistem berada di balik autentikasi. Pengguna harus login sebelum mengakses dashboard dan modul pengelolaan sistem.

Untuk pengembangan lebih lanjut, akses per-resource dapat diperketat menggunakan authorization/policy agar setiap data hanya dapat diakses sesuai hak pengguna.

Pengembangan Selanjutnya

Beberapa pengembangan yang dapat dilakukan:

Penerapan authorization/policy yang lebih detail.

Filter transaksi berdasarkan periode.

Filter laporan berdasarkan tanggal.

Export laporan apabila diperlukan.

Pagination pada data berjumlah besar.

Audit log aktivitas pengguna.

Backup dan restore database.

Pengujian otomatis menggunakan PHPUnit/Pest.

Status Project

Versi: 1.0
Status: Development

Project ini dikembangkan sebagai sistem kasir dan pencatatan keuangan untuk usaha hidroponik.