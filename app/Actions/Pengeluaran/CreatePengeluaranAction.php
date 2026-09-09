<?php

namespace App\Actions\Pengeluaran;

use App\Repositories\RepositoryInterface\PengeluaranRepositoryInterface;

class CreatePengeluaranAction
{
    protected $pengeluaranRepository;

    public function __construct(
        PengeluaranRepositoryInterface $pengeluaranRepository
    ) {
        $this->pengeluaranRepository = $pengeluaranRepository;
    }

    public function execute(array $data)
    {
        return $this->pengeluaranRepository->create($data);
    }
}