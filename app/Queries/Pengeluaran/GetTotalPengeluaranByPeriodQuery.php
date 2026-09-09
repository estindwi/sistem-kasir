<?php

namespace App\Queries\Pengeluaran;

use App\Repositories\RepositoryInterface\PengeluaranRepositoryInterface;

class GetTotalPengeluaranByPeriodQuery
{
    protected $pengeluaranRepository;

    public function __construct(
        PengeluaranRepositoryInterface $pengeluaranRepository
    ) {
        $this->pengeluaranRepository = $pengeluaranRepository;
    }

    public function execute($tanggalMulai, $tanggalSelesai)
    {
        return $this->pengeluaranRepository->totalByPeriod(
            $tanggalMulai,
            $tanggalSelesai
        );
    }
}