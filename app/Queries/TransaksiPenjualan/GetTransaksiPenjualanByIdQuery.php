<?php

namespace App\Queries\TransaksiPenjualan;

use App\Repositories\RepositoryInterface\TransaksiPenjualanRepositoryInterface;

class GetTransaksiPenjualanByIdQuery
{
    protected $transaksiRepository;

    public function __construct(
        TransaksiPenjualanRepositoryInterface $transaksiRepository
    ) {
        $this->transaksiRepository = $transaksiRepository;
    }

    public function execute($id)
    {
        return $this->transaksiRepository->find($id);
    }
}