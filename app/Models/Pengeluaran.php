<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'tanggal_pengeluaran',
        'jumlah',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pengeluaran' => 'date',
        'jumlah' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(
            KategoriPengeluaran::class,
            'kategori_id'
        );
    }
}