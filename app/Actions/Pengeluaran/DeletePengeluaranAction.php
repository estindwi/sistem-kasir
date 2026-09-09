<?php

namespace App\Actions\Pengeluaran;

use App\Repositories\RepositoryInterface\PengeluaranRepositoryInterface;

class DeletePengeluaranAction
{
    protected $pengeluaranRepository;

    public function __construct(
        PengeluaranRepositoryInterface $pengeluaranRepository
    ) {
        $this->pengeluaranRepository = $pengeluaranRepository;
    }

    public function execute($id)
    {
        return $this->pengeluaranRepository->delete($id);
    }
}