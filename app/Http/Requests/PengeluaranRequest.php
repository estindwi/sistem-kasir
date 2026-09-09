<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengeluaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_id' => [
                'required',
                'exists:kategori_pengeluaran,id',
            ],

            'tanggal_pengeluaran' => [
                'required',
                'date',
            ],

            'jumlah' => [
                'required',
                'numeric',
                'min:0',
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }
}