<?php

namespace App\Queries\KategoriPengeluaran;

use App\Repositories\RepositoryInterface\KategoriPengeluaranRepositoryInterface;

class GetKategoriPengeluaranQuery
{
    protected $kategoriRepository;

    public function __construct(
        KategoriPengeluaranRepositoryInterface $kategoriRepository
    ) {
        $this->kategoriRepository = $kategoriRepository;
    }

    public function execute()
    {
        return $this->kategoriRepository->all();
    }
}