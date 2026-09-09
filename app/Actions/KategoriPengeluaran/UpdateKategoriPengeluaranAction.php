<?php

namespace App\Actions\KategoriPengeluaran;

use App\Repositories\RepositoryInterface\KategoriPengeluaranRepositoryInterface;

class UpdateKategoriPengeluaranAction
{
    protected $kategoriRepository;

    public function __construct(
        KategoriPengeluaranRepositoryInterface $kategoriRepository
    ) {
        $this->kategoriRepository = $kategoriRepository;
    }

    public function execute($id, array $data)
    {
        return $this->kategoriRepository->update($id, $data);
    }
}