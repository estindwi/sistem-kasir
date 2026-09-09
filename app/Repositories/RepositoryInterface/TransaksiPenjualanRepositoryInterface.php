<?php

namespace App\Repositories\RepositoryInterface;

interface TransaksiPenjualanRepositoryInterface
{
    public function all();

    public function find($id);

    public function findByNumber($nomorTransaksi);

    public function create(array $data);

    public function byDate($tanggal);

    public function byPeriod($tanggalMulai, $tanggalSelesai);

    public function totalByPeriod($tanggalMulai, $tanggalSelesai);
}