<?php

namespace App\Actions\Produk;

use App\Repositories\RepositoryInterface\ProdukRepositoryInterface;

class UpdateStockAction
{
    protected $produkRepository;

    public function __construct(ProdukRepositoryInterface $produkRepository)
    {
        $this->produkRepository = $produkRepository;
    }

    public function execute($id, $jumlah)
    {
        return $this->produkRepository->updateStock($id, $jumlah);
    }
}