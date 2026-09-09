<?php

namespace App\Actions\TransaksiPenjualan;

use App\Models\Produk;
use App\Models\DetailTransaksi;
use App\Models\TransaksiPenjualan;
use Illuminate\Support\Facades\DB;
use Exception;

class AddDetailTransaksiAction
{
    public function execute(
        TransaksiPenjualan $transaksi,
        int $produkId,
        int $jumlah
    ) {
         if ($transaksi->status === 'completed') {
            throw new \Exception('Transaksi sudah diselesaikan dan tidak dapat ditambahkan produk lagi.');
        }


        return DB::transaction(function () use ($transaksi, $produkId, $jumlah) {

            $produk = Produk::where('id', $produkId)
                ->where('status', true)
                ->lockForUpdate()
                ->first();

            if (!$produk) {
                throw new Exception('Produk tidak ditemukan atau sudah tidak aktif.');
            }

            if ($jumlah <= 0) {
                throw new Exception('Jumlah produk harus lebih dari 0.');
            }

            if ($jumlah > $produk->stok) {
                throw new Exception('Jumlah pembelian melebihi stok produk.');
            }

            $subtotal = $jumlah * $produk->harga;

            $detail = DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk->id,
                'jumlah' => $jumlah,
                'harga_satuan' => $produk->harga,
                'subtotal' => $subtotal,
            ]);

            $produk->decrement('stok', $jumlah);

            $transaksi->increment('total', $subtotal);

            return $detail;
        });
    }
}