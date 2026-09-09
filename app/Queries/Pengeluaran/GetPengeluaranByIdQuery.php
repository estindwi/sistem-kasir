<?php

namespace App\Queries\Pengeluaran;

use App\Repositories\RepositoryInterface\PengeluaranRepositoryInterface;

class GetPengeluaranByIdQuery
{
    protected $pengeluaranRepository;

    public function __construct(
        PengeluaranRepositoryInterface $pengeluaranRepository
    ) {
        $this->pengeluaranRepository = $pengeluaranRepository;
    }

    public function execute($id)
    {
        return $this->pengeluaranRepository->find($id);
    }
}