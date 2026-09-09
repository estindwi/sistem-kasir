<?php

namespace App\Actions\Pengeluaran;

use App\Repositories\RepositoryInterface\PengeluaranRepositoryInterface;

class UpdatePengeluaranAction
{
    protected $pengeluaranRepository;

    public function __construct(
        PengeluaranRepositoryInterface $pengeluaranRepository
    ) {
        $this->pengeluaranRepository = $pengeluaranRepository;
    }

    public function execute($id, array $data)
    {
        return $this->pengeluaranRepository->update($id, $data);
    }
}