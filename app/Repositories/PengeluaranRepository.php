<?php

namespace App\Repositories;

use App\Models\Pengeluaran;
use App\Repositories\RepositoryInterface\PengeluaranRepositoryInterface;

class PengeluaranRepository implements PengeluaranRepositoryInterface
{
    protected $model;

    public function __construct(Pengeluaran $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model
            ->with('kategori')
            ->latest('tanggal_pengeluaran')
            ->get();
    }

    public function find($id)
    {
        return $this->model
            ->with('kategori')
            ->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $pengeluaran = $this->model->find($id);

        if (!$pengeluaran) {
            return null;
        }

        $pengeluaran->update($data);

        return $pengeluaran;
    }

    public function delete($id)
    {
        $pengeluaran = $this->model->find($id);

        if (!$pengeluaran) {
            return false;
        }

        return $pengeluaran->delete();
    }

    public function byDate($tanggal)
    {
        return $this->model
            ->whereDate('tanggal_pengeluaran', $tanggal)
            ->with('kategori')
            ->latest('tanggal_pengeluaran')
            ->get();
    }

    public function byPeriod($tanggalMulai, $tanggalSelesai)
    {
        return $this->model
            ->whereBetween('tanggal_pengeluaran', [
                $tanggalMulai,
                $tanggalSelesai,
            ])
            ->with('kategori')
            ->latest('tanggal_pengeluaran')
            ->get();
    }

    public function totalByPeriod($tanggalMulai, $tanggalSelesai)
    {
        return $this->model
            ->whereBetween('tanggal_pengeluaran', [
                $tanggalMulai,
                $tanggalSelesai,
            ])
            ->sum('jumlah');
    }
}