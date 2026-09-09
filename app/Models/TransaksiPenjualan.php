<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransaksiPenjualan extends Model
{
    protected $table = 'transaksi_penjualan';

    protected $fillable = [
        'nomor_transaksi',
        'user_id',
        'tanggal_transaksi',
        'total',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_transaksi' => 'datetime',
            'total' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }
}