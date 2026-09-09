<?php

namespace App\Queries\Produk;

use App\Repositories\RepositoryInterface\ProdukRepositoryInterface;

class GetProdukQuery
{
    protected $produkRepository;

    public function __construct(ProdukRepositoryInterface $produkRepository)
    {
        $this->produkRepository = $produkRepository;
    }

    public function execute()
    {
        return $this->produkRepository->all();
    }
}