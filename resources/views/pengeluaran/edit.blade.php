<x-layout active="pengeluaran">

    <x-breadcrumb
        :items="[
            [
                'label' => 'Pengeluaran',
                'url' => route('pengeluaran.index')
            ],
            [
                'label' => 'Edit Pengeluaran'
            ]
        ]"
    />

    <x-page-header
        title="Edit Pengeluaran"
        description="Perbarui data pengeluaran yang sudah tercatat."
    />

    <x-card title="Informasi Pengeluaran">

        <form
            action="{{ route('pengeluaran.update', $pengeluaran->id) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label
                        for="tanggal_pengeluaran"
                        class="form-label fw-semibold"
                    >
                        Tanggal Pengeluaran
                    </label>

                    <input
                        type="date"
                        name="tanggal_pengeluaran"
                        id="tanggal_pengeluaran"
                        class="form-control"
                        value="{{ old('tanggal_pengeluaran', $pengeluaran->tanggal_pengeluaran?->format('Y-m-d')) }}"
                        required
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label
                        for="kategori_id"
                        class="form-label fw-semibold"
                    >
                        Kategori Pengeluaran
                    </label>

                    <select
                        name="kategori_id"
                        id="kategori_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach ($kategori as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ old('kategori_id', $pengeluaran->kategori_id) == $item->id ? 'selected' : '' }}
                            >
                                {{ $item->nama_kategori }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-md-6 mb-3">

                    <label
                        for="jumlah"
                        class="form-label fw-semibold"
                    >
                        Nominal Pengeluaran
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="jumlah"
                            id="jumlah"
                            class="form-control"
                            value="{{ old('jumlah', $pengeluaran->jumlah) }}"
                            min="1"
                            step="0.01"
                            required
                        >

                    </div>

                </div>


                <div class="col-md-12 mb-3">

                    <label
                        for="keterangan"
                        class="form-label fw-semibold"
                    >
                        Keterangan
                    </label>

                    <textarea
                        name="keterangan"
                        id="keterangan"
                        class="form-control"
                        rows="4"
                        maxlength="1000"
                        placeholder="Contoh: Pembelian token listrik bulan September"
                    >{{ old('keterangan', $pengeluaran->keterangan) }}</textarea>

                </div>

            </div>


            <div class="expense-summary">

                <div class="summary-icon">
                    <x-icon name="lucide:wallet" />
                </div>

                <div>
                    <span>
                        Nominal pengeluaran
                    </span>

                    <strong>
                        Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}
                    </strong>
                </div>

            </div>


            <div class="form-actions">

                <x-button
                    variant="outline-secondary"
                    :href="route('pengeluaran.index')"
                >
                    <x-icon name="lucide:arrow-left" />
                    Batal
                </x-button>

                <x-button
                    variant="success"
                    type="submit"
                >
                    <x-icon name="lucide:save" />
                    Simpan Perubahan
                </x-button>

            </div>

        </form>

    </x-card>


    <style>

        .form-control,
        .form-select {
            min-height: 44px;
            border-radius: 10px;
        }

        textarea.form-control {
            min-height: 110px;
        }

        .input-group-text {
            background: #f5f7f6;
            color: #4b5563;
            font-weight: 600;
        }

        .expense-summary {
            display: flex;
            align-items: center;
            gap: 12px;

            margin-top: 10px;
            padding: 14px 16px;

            border-radius: 10px;

            background: #f3f8f4;
        }

        .summary-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 10px;

            background: #e1f0e4;
            color: #2e7d32;
        }

        .summary-icon iconify-icon {
            font-size: 18px;
        }

        .expense-summary span {
            display: block;

            margin-bottom: 2px;

            color: #6b7280;
            font-size: 12px;
        }

        .expense-summary strong {
            color: #2e7d32;
            font-size: 16px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;

            margin-top: 28px;
            padding-top: 20px;

            border-top: 1px solid #e5e7eb;
        }

        @media (max-width: 576px) {

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .ui-button {
                width: 100%;
            }

        }

    </style>

</x-layout>