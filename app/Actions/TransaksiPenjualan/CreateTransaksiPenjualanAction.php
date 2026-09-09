<?php

namespace App\Actions\TransaksiPenjualan;

use App\Repositories\RepositoryInterface\TransaksiPenjualanRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CreateTransaksiPenjualanAction
{
    protected $transaksiRepository;

    public function __construct(
        TransaksiPenjualanRepositoryInterface $transaksiRepository
    ) {
        $this->transaksiRepository = $transaksiRepository;
    }

    public function execute(array $data)
    {
        $data['nomor_transaksi'] = 'TRX-' . date('YmdHis');
        $data['user_id'] = Auth::id();
        $data['tanggal_transaksi'] = $data['tanggal_transaksi'] ?? now();
        $data['total'] = $data['total'] ?? 0;
        $data['status'] = $data['status'] ?? 'draft';

        return $this->transaksiRepository->create($data);
    }
}