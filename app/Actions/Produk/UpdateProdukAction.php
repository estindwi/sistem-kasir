<?php

namespace App\Actions\Produk;

use App\Repositories\RepositoryInterface\ProdukRepositoryInterface;

class UpdateProdukAction
{
    protected $produkRepository;

    public function __construct(ProdukRepositoryInterface $produkRepository)
    {
        $this->produkRepository = $produkRepository;
    }

    public function execute($id, array $data)
    {
        return $this->produkRepository->update($id, $data);
    }
}