<?php

namespace App\Repositories;

use App\Models\KategoriPengeluaran;
use App\Repositories\RepositoryInterface\KategoriPengeluaranRepositoryInterface;

class KategoriPengeluaranRepository implements KategoriPengeluaranRepositoryInterface
{
    protected $model;

    public function __construct(KategoriPengeluaran $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model
            ->withCount('pengeluaran')
            ->orderBy('nama_kategori')
            ->get();
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
        $kategori = $this->model->find($id);

        if (!$kategori) {
            return null;
        }

        $kategori->update($data);

        return $kategori;
    }

    public function delete($id)
    {
        $kategori = $this->model->find($id);

        if (!$kategori) {
            return false;
        }

        return $kategori->delete();
    }
}