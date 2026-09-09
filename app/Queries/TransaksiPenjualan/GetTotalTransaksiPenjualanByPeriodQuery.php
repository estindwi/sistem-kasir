<?php

namespace App\Queries\TransaksiPenjualan;

use App\Repositories\RepositoryInterface\TransaksiPenjualanRepositoryInterface;

class GetTotalTransaksiPenjualanByPeriodQuery
{
    protected $transaksiRepository;

    public function __construct(
        TransaksiPenjualanRepositoryInterface $transaksiRepository
    ) {
        $this->transaksiRepository = $transaksiRepository;
    }

    public function execute($tanggalMulai, $tanggalSelesai)
    {
        return $this->transaksiRepository->totalByPeriod(
            $tanggalMulai,
            $tanggalSelesai
        );
    }
}