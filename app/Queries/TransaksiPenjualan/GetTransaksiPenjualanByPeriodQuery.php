<?php

namespace App\Queries\TransaksiPenjualan;

use App\Repositories\RepositoryInterface\TransaksiPenjualanRepositoryInterface;

class GetTransaksiPenjualanByPeriodQuery
{
    protected $transaksiRepository;

    public function __construct(
        TransaksiPenjualanRepositoryInterface $transaksiRepository
    ) {
        $this->transaksiRepository = $transaksiRepository;
    }

    public function execute($tanggalMulai, $tanggalSelesai)
    {
        return $this->transaksiRepository->byPeriod(
            $tanggalMulai,
            $tanggalSelesai
        );
    }
}