<?php

namespace App\Queries\Produk;

use App\Repositories\RepositoryInterface\ProdukRepositoryInterface;

class GetProdukByIdQuery
{
    protected $produkRepository;

    public function __construct(ProdukRepositoryInterface $produkRepository)
    {
        $this->produkRepository = $produkRepository;
    }

    public function execute($id)
    {
        return $this->produkRepository->find($id);
    }
}