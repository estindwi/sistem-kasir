<?php

namespace App\Actions\KategoriPengeluaran;

use App\Repositories\RepositoryInterface\KategoriPengeluaranRepositoryInterface;

class CreateKategoriPengeluaranAction
{
    protected $kategoriRepository;

    public function __construct(
        KategoriPengeluaranRepositoryInterface $kategoriRepository
    ) {
        $this->kategoriRepository = $kategoriRepository;
    }

    public function execute(array $data)
    {
        return $this->kategoriRepository->create($data);
    }
}