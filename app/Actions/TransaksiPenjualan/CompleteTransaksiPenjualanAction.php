<?php

namespace App\Actions\TransaksiPenjualan;

use App\Models\TransaksiPenjualan;

class CompleteTransaksiPenjualanAction
{
    public function execute(TransaksiPenjualan $transaksi)
    {
        if ($transaksi->details->count() === 0) {
            throw new \Exception('Transaksi belum memiliki produk.');
        }

        if ($transaksi->status === 'completed') {
            throw new \Exception('Transaksi sudah diselesaikan.');
        }

        $transaksi->update([
            'status' => 'completed',
        ]);

        return $transaksi->fresh();
    }
}