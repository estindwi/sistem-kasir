<?php

namespace App\Actions\Produk;

use App\Repositories\RepositoryInterface\ProdukRepositoryInterface;

class DeactivateProdukAction
{
    protected $produkRepository;

    public function __construct(ProdukRepositoryInterface $produkRepository)
    {
        $this->produkRepository = $produkRepository;
    }

    public function execute($id)
    {
        return $this->produkRepository->deactivate($id);
    }
}