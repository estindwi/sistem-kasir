<?php

namespace App\Queries\Produk;

use App\Repositories\RepositoryInterface\ProdukRepositoryInterface;

class GetLowStockProdukQuery
{
    protected $produkRepository;

    public function __construct(ProdukRepositoryInterface $produkRepository)
    {
        $this->produkRepository = $produkRepository;
    }

    public function execute($batas = 10)
    {
        return $this->produkRepository->lowStock($batas);
    }
}