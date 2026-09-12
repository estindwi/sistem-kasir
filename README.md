# Sistem Kasir Hidroponik

Sistem Kasir Hidroponik merupakan aplikasi berbasis web yang digunakan untuk membantu pengelolaan transaksi penjualan, produk, pengeluaran, serta laporan keuangan pada usaha hidroponik.

Project ini dibuat menggunakan Laravel dengan menerapkan struktur repository, action, query, controller, dan Blade component.

---

## Fitur

### 1. Autentikasi
- Login menggunakan username dan password
- Password tersimpan dalam bentuk hash
- Sistem hanya dapat diakses oleh pengguna yang sudah login
- Role pengguna: Owner Hidroponik

### 2. Manajemen Produk
- Menampilkan daftar produk
- Menambahkan produk
- Mengubah data produk
- Mengatur stok produk
- Menonaktifkan produk
- Menampilkan informasi stok rendah

### 3. Transaksi Penjualan
- Membuat transaksi baru
- Nomor transaksi dibuat secara otomatis
- Menambahkan produk ke transaksi
- Menghitung subtotal secara otomatis
- Menghitung total transaksi
- Stok produk berkurang otomatis setelah produk ditambahkan
- Menyelesaikan transaksi
- Menampilkan riwayat transaksi

### 4. Detail Transaksi
- Menampilkan detail produk dalam transaksi
- Mengatur jumlah produk
- Perhitungan subtotal berdasarkan jumlah × harga satuan
- Validasi jumlah tidak boleh melebihi stok

### 5. Kategori Pengeluaran
- Menambahkan kategori pengeluaran
- Mengubah kategori
- Menghapus kategori
- Menampilkan daftar kategori

### 6. Pengeluaran
- Mencatat pengeluaran
- Menentukan kategori pengeluaran
- Menentukan tanggal pengeluaran
- Menambahkan jumlah pengeluaran
- Menambahkan keterangan
- Mengubah data pengeluaran
- Menghapus data pengeluaran
- Menampilkan riwayat pengeluaran

### 7. Laporan Keuangan
- Menampilkan total pendapatan
- Menampilkan total pengeluaran
- Menampilkan saldo bersih
- Rekap keuangan bulanan
- Rekap keuangan tahunan
- Grafik pendapatan dan pengeluaran
- Grafik pengeluaran berdasarkan kategori
- Menampilkan persentase margin bersih

### 8. Dashboard
- Jumlah transaksi
- Total pendapatan
- Total pengeluaran
- Saldo bersih
- Transaksi terbaru
- Informasi stok rendah
- Ringkasan keuangan

---

## Teknologi

- PHP 8.5.1
- Laravel 13
- MySQL
- Blade
- Bootstrap
- Iconify
- SweetAlert2
- Laragon

---

## Struktur Project

Struktur utama yang digunakan:

```text
app/
├── Actions/
├── Http/
│   ├── Controllers/
│   └── Requests/
├── Models/
├── Queries/
├── Repositories/
│   ├── RepositoryInterface/
│   └── ...
└── View/
    └── Components/

database/
├── migrations/
└── seeders/

resources/
└── views/
    ├── auth/
    ├── components/
    ├── dashboard/
    ├── produk/
    ├── transaksi/
    ├── kategori_pengeluaran/
    ├── pengeluaran/
    └── financial_report/