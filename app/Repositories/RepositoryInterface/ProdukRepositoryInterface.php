<?php

namespace App\Repositories\RepositoryInterface;

interface ProdukRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function deactivate($id);

    public function updateStock($id, $jumlah);

    public function lowStock($batas = 10);
}