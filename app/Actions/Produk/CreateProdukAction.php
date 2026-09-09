<?php

namespace App\Actions\Produk;

use App\Repositories\RepositoryInterface\ProdukRepositoryInterface;

class CreateProdukAction
{
    protected $produkRepository;

    public function __construct(ProdukRepositoryInterface $produkRepository)
    {
        $this->produkRepository = $produkRepository;
    }

    public function execute(array $data)
    {
        return $this->produkRepository->create($data);
    }
}