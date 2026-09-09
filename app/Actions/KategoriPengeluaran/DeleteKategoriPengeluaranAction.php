<?php

namespace App\Actions\KategoriPengeluaran;

use App\Repositories\RepositoryInterface\KategoriPengeluaranRepositoryInterface;

class DeleteKategoriPengeluaranAction
{
    protected $kategoriRepository;

    public function __construct(
        KategoriPengeluaranRepositoryInterface $kategoriRepository
    ) {
        $this->kategoriRepository = $kategoriRepository;
    }

    public function execute($id)
    {
        return $this->kategoriRepository->delete($id);
    }
}