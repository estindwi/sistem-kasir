<?php

namespace Database\Seeders;

use App\Models\DetailTransaksi;
use App\Models\KategoriPengeluaran;
use App\Models\Pengeluaran;
use App\Models\Produk;
use App\Models\TransaksiPenjualan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            /*
            |--------------------------------------------------------------------------
            | USER
            |--------------------------------------------------------------------------
            */

            $user = User::where('username', 'owner')->first();

            if (!$user) {
                $this->command->error(
                    'User owner tidak ditemukan. Jalankan UserSeeder terlebih dahulu.'
                );

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | PRODUK
            |--------------------------------------------------------------------------
            */

            $produkData = [
                [
                    'nama_produk' => 'Selada',
                    'harga' => 15000,
                    'stok' => 100,
                ],
                [
                    'nama_produk' => 'Pakcoy',
                    'harga' => 12000,
                    'stok' => 100,
                ],
                [
                    'nama_produk' => 'Kangkung',
                    'harga' => 10000,
                    'stok' => 100,
                ],
                [
                    'nama_produk' => 'Bayam',
                    'harga' => 10000,
                    'stok' => 100,
                ],
                [
                    'nama_produk' => 'Sawi',
                    'harga' => 11000,
                    'stok' => 100,
                ],
                [
                    'nama_produk' => 'Tomat Cherry',
                    'harga' => 18000,
                    'stok' => 100,
                ],
            ];

            $produk = [];

            foreach ($produkData as $data) {

                $produk[$data['nama_produk']] = Produk::create([
                    'nama_produk' => $data['nama_produk'],
                    'harga' => $data['harga'],
                    'stok' => $data['stok'],
                    'status' => true,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | KATEGORI PENGELUARAN
            |--------------------------------------------------------------------------
            */

            $kategoriData = [
                'Pupuk',
                'Bibit',
                'Nutrisi',
                'Listrik',
                'Air',
                'Operasional',
            ];

            $kategori = [];

            foreach ($kategoriData as $nama) {

                $kategori[$nama] = KategoriPengeluaran::create([
                    'nama_kategori' => $nama,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | TRANSAKSI PENJUALAN
            |--------------------------------------------------------------------------
            */

            $transaksiData = [

                [
                    'tanggal' => '2026-01-10 09:15:00',
                    'details' => [
                        ['produk' => 'Selada', 'jumlah' => 5],
                        ['produk' => 'Pakcoy', 'jumlah' => 3],
                    ],
                ],

                [
                    'tanggal' => '2026-02-08 14:20:00',
                    'details' => [
                        ['produk' => 'Kangkung', 'jumlah' => 8],
                        ['produk' => 'Bayam', 'jumlah' => 4],
                    ],
                ],

                [
                    'tanggal' => '2026-03-12 10:10:00',
                    'details' => [
                        ['produk' => 'Selada', 'jumlah' => 7],
                        ['produk' => 'Sawi', 'jumlah' => 5],
                    ],
                ],

                [
                    'tanggal' => '2026-04-18 16:30:00',
                    'details' => [
                        ['produk' => 'Tomat Cherry', 'jumlah' => 6],
                        ['produk' => 'Pakcoy', 'jumlah' => 5],
                    ],
                ],

                [
                    'tanggal' => '2026-05-06 11:45:00',
                    'details' => [
                        ['produk' => 'Selada', 'jumlah' => 10],
                        ['produk' => 'Kangkung', 'jumlah' => 6],
                    ],
                ],

                [
                    'tanggal' => '2026-06-14 15:10:00',
                    'details' => [
                        ['produk' => 'Bayam', 'jumlah' => 8],
                        ['produk' => 'Pakcoy', 'jumlah' => 7],
                    ],
                ],

                [
                    'tanggal' => '2026-07-09 13:00:00',
                    'details' => [
                        ['produk' => 'Sawi', 'jumlah' => 9],
                        ['produk' => 'Tomat Cherry', 'jumlah' => 4],
                    ],
                ],

                [
                    'tanggal' => '2026-08-05 09:40:00',
                    'details' => [
                        ['produk' => 'Selada', 'jumlah' => 8],
                        ['produk' => 'Pakcoy', 'jumlah' => 6],
                    ],
                ],

                [
                    'tanggal' => '2026-09-03 10:00:00',
                    'details' => [
                        ['produk' => 'Selada', 'jumlah' => 12],
                        ['produk' => 'Kangkung', 'jumlah' => 10],
                    ],
                ],

                [
                    'tanggal' => '2026-09-07 14:30:00',
                    'details' => [
                        ['produk' => 'Pakcoy', 'jumlah' => 8],
                        ['produk' => 'Bayam', 'jumlah' => 5],
                        ['produk' => 'Sawi', 'jumlah' => 4],
                    ],
                ],

                [
                    'tanggal' => '2026-09-09 16:00:00',
                    'details' => [
                        ['produk' => 'Tomat Cherry', 'jumlah' => 10],
                        ['produk' => 'Selada', 'jumlah' => 6],
                    ],
                ],

                [
                    'tanggal' => '2026-09-12 10:30:00',
                    'details' => [
                        ['produk' => 'Selada', 'jumlah' => 15],
                        ['produk' => 'Pakcoy', 'jumlah' => 8],
                    ],
                ],
            ];


            foreach ($transaksiData as $index => $data) {

                $tanggal = Carbon::parse($data['tanggal']);

                $nomorTransaksi =
                    'TRX-' .
                    $tanggal->format('Ymd') .
                    '-' .
                    str_pad($index + 1, 3, '0', STR_PAD_LEFT);


                $transaksi = TransaksiPenjualan::create([
                    'nomor_transaksi' => $nomorTransaksi,
                    'user_id' => $user->id,
                    'tanggal_transaksi' => $tanggal,
                    'total' => 0,
                    'status' => 'draft',
                ]);


                $total = 0;


                foreach ($data['details'] as $detailData) {

                    $item = $produk[$detailData['produk']];
                    $jumlah = $detailData['jumlah'];
                    $hargaSatuan = (float) $item->harga;
                    $subtotal = $hargaSatuan * $jumlah;

                    DetailTransaksi::create([
                        'transaksi_id' => $transaksi->id,
                        'produk_id' => $item->id,
                        'jumlah' => $jumlah,
                        'harga_satuan' => $hargaSatuan,
                        'subtotal' => $subtotal,
                    ]);

                    $item->decrement('stok', $jumlah);

                    $total += $subtotal;
                }


                $transaksi->update([
                    'total' => $total,
                    'status' => 'completed',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | PENGELUARAN
            |--------------------------------------------------------------------------
            */

            $pengeluaranData = [

                [
                    'tanggal' => '2026-01-05',
                    'kategori' => 'Pupuk',
                    'jumlah' => 350000,
                    'keterangan' => 'Pembelian pupuk hidroponik',
                ],

                [
                    'tanggal' => '2026-02-03',
                    'kategori' => 'Bibit',
                    'jumlah' => 200000,
                    'keterangan' => 'Pembelian bibit sayuran',
                ],

                [
                    'tanggal' => '2026-03-10',
                    'kategori' => 'Listrik',
                    'jumlah' => 175000,
                    'keterangan' => 'Token listrik instalasi hidroponik',
                ],

                [
                    'tanggal' => '2026-04-08',
                    'kategori' => 'Nutrisi',
                    'jumlah' => 250000,
                    'keterangan' => 'Pembelian nutrisi tanaman',
                ],

                [
                    'tanggal' => '2026-05-12',
                    'kategori' => 'Air',
                    'jumlah' => 150000,
                    'keterangan' => 'Biaya penggunaan air',
                ],

                [
                    'tanggal' => '2026-06-04',
                    'kategori' => 'Operasional',
                    'jumlah' => 275000,
                    'keterangan' => 'Biaya operasional kebun',
                ],

                [
                    'tanggal' => '2026-07-15',
                    'kategori' => 'Pupuk',
                    'jumlah' => 400000,
                    'keterangan' => 'Pembelian pupuk tambahan',
                ],

                [
                    'tanggal' => '2026-08-07',
                    'kategori' => 'Listrik',
                    'jumlah' => 180000,
                    'keterangan' => 'Token listrik bulan Agustus',
                ],

                [
                    'tanggal' => '2026-09-02',
                    'kategori' => 'Listrik',
                    'jumlah' => 150000,
                    'keterangan' => 'Token listrik bulan September',
                ],

                [
                    'tanggal' => '2026-09-04',
                    'kategori' => 'Pupuk',
                    'jumlah' => 300000,
                    'keterangan' => 'Pembelian pupuk AB Mix',
                ],

                [
                    'tanggal' => '2026-09-06',
                    'kategori' => 'Bibit',
                    'jumlah' => 225000,
                    'keterangan' => 'Pembelian bibit selada dan pakcoy',
                ],

                [
                    'tanggal' => '2026-09-08',
                    'kategori' => 'Air',
                    'jumlah' => 125000,
                    'keterangan' => 'Pembayaran kebutuhan air',
                ],

                [
                    'tanggal' => '2026-09-10',
                    'kategori' => 'Nutrisi',
                    'jumlah' => 275000,
                    'keterangan' => 'Pembelian nutrisi tanaman',
                ],

                [
                    'tanggal' => '2026-09-11',
                    'kategori' => 'Operasional',
                    'jumlah' => 200000,
                    'keterangan' => 'Biaya operasional kebun',
                ],
            ];


            foreach ($pengeluaranData as $data) {

                Pengeluaran::create([
                    'user_id' => $user->id,
                    'kategori_id' => $kategori[$data['kategori']]->id,
                    'tanggal_pengeluaran' => $data['tanggal'],
                    'jumlah' => $data['jumlah'],
                    'keterangan' => $data['keterangan'],
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | INFORMASI SEEDER
            |--------------------------------------------------------------------------
            */

            $this->command->info(
                'Dummy data berhasil dibuat.'
            );

            $this->command->info(
                'Produk: ' . count($produkData)
            );

            $this->command->info(
                'Kategori: ' . count($kategoriData)
            );

            $this->command->info(
                'Transaksi: ' . count($transaksiData)
            );

            $this->command->info(
                'Pengeluaran: ' . count($pengeluaranData)
            );
        });
    }
}