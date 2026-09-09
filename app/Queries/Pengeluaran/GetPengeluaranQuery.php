<?php

namespace App\Queries\Pengeluaran;

use App\Repositories\RepositoryInterface\PengeluaranRepositoryInterface;

class GetPengeluaranQuery
{
    protected $pengeluaranRepository;

    public function __construct(
        PengeluaranRepositoryInterface $pengeluaranRepository
    ) {
        $this->pengeluaranRepository = $pengeluaranRepository;
    }

    public function execute()
    {
        return $this->pengeluaranRepository->all();
    }
}