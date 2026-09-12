<?php

namespace App\Queries\Dashboard;

use App\Models\Produk;
use App\Models\TransaksiPenjualan;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class GetDashboardQuery
{
    public function execute(): array
    {
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();

        $jumlahTransaksi = TransaksiPenjualan::query()
            ->where('status', 'completed')
            ->whereBetween('tanggal_transaksi', [
                $awalBulan,
                $akhirBulan,
            ])
            ->count();

        $totalPendapatan = TransaksiPenjualan::query()
            ->where('status', 'completed')
            ->whereBetween('tanggal_transaksi', [
                $awalBulan,
                $akhirBulan,
            ])
            ->sum('total');

        $totalPengeluaran = Pengeluaran::query()
            ->whereBetween('tanggal_pengeluaran', [
                $awalBulan->toDateString(),
                $akhirBulan->toDateString(),
            ])
            ->sum('jumlah');

        $saldoBersih = $totalPendapatan - $totalPengeluaran;

        $stokMenipis = Produk::query()
            ->where('status', true)
            ->where('stok', '<=', 10)
            ->orderBy('stok')
            ->get();

        $transaksiTerbaru = TransaksiPenjualan::query()
            ->with('user')
            ->where('status', 'completed')
            ->latest('tanggal_transaksi')
            ->take(5)
            ->get();

        return [
            'jumlahTransaksi' => $jumlahTransaksi,
            'totalPendapatan' => $totalPendapatan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldoBersih' => $saldoBersih,
            'stokMenipis' => $stokMenipis,
            'transaksiTerbaru' => $transaksiTerbaru,
            'periode' => $awalBulan->translatedFormat('F Y'),
        ];
    }
}