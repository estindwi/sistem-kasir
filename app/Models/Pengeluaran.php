<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';

    protected $fillable = [
        'kategori_id',
        'tanggal_pengeluaran',
        'jumlah',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pengeluaran' => 'date',
            'jumlah' => 'decimal:2',
        ];
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(
            KategoriPengeluaran::class,
            'kategori_id'
        );
    }
}