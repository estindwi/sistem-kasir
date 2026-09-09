<?php

namespace App\Repositories;

use App\Models\TransaksiPenjualan;
use App\Repositories\RepositoryInterface\TransaksiPenjualanRepositoryInterface;

class TransaksiPenjualanRepository implements TransaksiPenjualanRepositoryInterface
{
    protected $model;

    public function __construct(TransaksiPenjualan $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('user')->latest('tanggal_transaksi')->get();
    }

    public function find($id)
    {
        return $this->model->with(['user', 'details.produk'])->find($id);
    }

    public function findByNumber($nomorTransaksi)
    {
        return $this->model
            ->with(['user', 'details.produk'])
            ->where('nomor_transaksi', $nomorTransaksi)
            ->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function byDate($tanggal)
    {
        return $this->model
            ->whereDate('tanggal_transaksi', $tanggal)
            ->with('user')
            ->latest('tanggal_transaksi')
            ->get();
    }

    public function byPeriod($tanggalMulai, $tanggalSelesai)
    {
        return $this->model
            ->whereBetween('tanggal_transaksi', [
                $tanggalMulai . ' 00:00:00',
                $tanggalSelesai . ' 23:59:59',
            ])
            ->with('user')
            ->latest('tanggal_transaksi')
            ->get();
    }

    public function totalByPeriod($tanggalMulai, $tanggalSelesai)
    {
        return $this->model
            ->whereBetween('tanggal_transaksi', [
                $tanggalMulai . ' 00:00:00',
                $tanggalSelesai . ' 23:59:59',
            ])
            ->sum('total');
    }
}