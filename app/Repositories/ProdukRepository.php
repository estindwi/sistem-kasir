<?php

namespace App\Repositories;

use App\Models\Produk;
use App\Repositories\RepositoryInterface\ProdukRepositoryInterface;

class ProdukRepository implements ProdukRepositoryInterface
{
    protected $model;

    public function __construct(Produk $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $produk = $this->model->find($id);

        if (!$produk) {
            return null;
        }

        $produk->update($data);

        return $produk;
    }

    public function deactivate($id)
    {
        $produk = $this->model->find($id);

        if (!$produk) {
            return null;
        }

        $produk->update([
            'status' => false,
        ]);

        return $produk;
    }

    public function updateStock($id, $jumlah)
    {
        $produk = $this->model->find($id);

        if (!$produk) {
            return null;
        }

        $produk->update([
            'stok' => $jumlah,
        ]);

        return $produk;
    }

    public function lowStock($batas = 10)
    {
        return $this->model
            ->where('status', true)
            ->where('stok', '<=', $batas)
            ->get();
    }
}