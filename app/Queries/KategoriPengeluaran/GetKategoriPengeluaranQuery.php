<?php

namespace App\Queries\KategoriPengeluaran;

use App\Models\KategoriPengeluaran;

class GetKategoriPengeluaranQuery
{
    public function execute()
    {
        return KategoriPengeluaran::withCount('pengeluaran')
            ->withSum('pengeluaran', 'jumlah')
            ->orderBy('nama_kategori')
            ->get();
    }
}