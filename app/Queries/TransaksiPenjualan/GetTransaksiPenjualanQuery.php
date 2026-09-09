<?php

namespace App\Queries\TransaksiPenjualan;

use App\Repositories\RepositoryInterface\TransaksiPenjualanRepositoryInterface;

class GetTransaksiPenjualanQuery
{
    protected $transaksiRepository;

    public function __construct(
        TransaksiPenjualanRepositoryInterface $transaksiRepository
    ) {
        $this->transaksiRepository = $transaksiRepository;
    }

    public function execute()
    {
        return $this->transaksiRepository->all();
    }
}